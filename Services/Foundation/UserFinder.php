<?php

namespace Maestro\Users\Services\Foundation;

use Illuminate\Database\Eloquent\Builder;
use Maestro\Users\Entities\User;
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
     * @return \Maestro\Users\Entities\User|null
     */
    public function find(int $id) : ?User
    {
        return User::find($id);
    }

    public function search(string $search) : Builder
    {
        return User::search($search);
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
     * Verifica se o parâmetro passado se trata de um objeto
     * do tipo User, pertencente ao Maestro/User. 
     * Se sim, deve retornar true. 
     * Caso contrário, deve retornar false.
     * 
     *
     * @param mixed $param
     * @return boolean
     */
    public function isUser(mixed $param) : bool
    {
        return ($param instanceof User) ? true : false;
    }
}