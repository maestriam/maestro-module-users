<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Users\Database\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maestro\Users\Exceptions\UserNotFoundException;

class UserFinder 
{
    /**
     * Retorna a lista de TODOS os usuários cadastrados.
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return User::all();
    }

    /**
     * Retorna um usuário pelo seu ID.
     *
     * @param int $id  
     * @return object
     */
    public function find(int $id) : User
    {
        return User::find($id);
    }

    /**
     * Retorna um usuário pelo seu ID ou envia um exception.
     *
     * @param integer $id
     * @return User
     */
    public function findOrFail(int $id) : User 
    {
        $user = $this->find($id);

        if (! $user) {
            throw new UserNotFoundException($id);            
        }
        
        return $user;
    }

    /**
     * Retorna uma lista de usuários
     *
     * @param Collection $users
     * @return array
     */
    private function toList(Collection $users) : array
    {
        $list = [];

        foreach($users as $user) {

            $object = $this->toResponse($user);

            array_push($list, $object);
        }

        return $list;
    }

    /**
     * Retorna um objeto com todas os dados principais do usuário.  
     * 
     * @param User $user
     * @return object
     */
    private function toResponse(User $user) : object
    {
        $user = [
            'id'          => $user->id,
            'firstName'   => $user->first_name,
            'lastName'    => $user->last_name,
            'accountName' => $user->account()->name,
            'email'       => $user->email,
            'createdAt'   => $user->created_at->format('d/m/Y H:i'),
            'updatedAt'   => $user->updated_at->format('d/m/Y H:i'),
        ];

        return (object) $user;
    }
}