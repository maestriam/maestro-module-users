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
     * @return \Maestro\Users\Database\Models\User|null
     */
    public function find(int $id) : ?User
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
}