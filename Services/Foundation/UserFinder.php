<?php

namespace Maestro\Users\Services\Foundation;

use Illuminate\Database\Eloquent\Builder;
use Maestro\Users\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Maestro\Accounts\Support\Accounts;
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

    /**
     * Verifica se o e-mail especificado pertence a um determinado
     * usuário. Se pertencer, deve retornar true.  
     *
     * @param string $email
     * @param integer $id
     * @return bool
     */
    public function belongsTo(string $email, int $id) : bool
    {
        $params = ['email' => $email, 'id' => $id];

        $found = User::where($params)->get();

        return ($found->isEmpty() == true) ? false : true;
    }

    /**
     * Verifica se já existe um usuário criado com um determinado
     * e-mail ou conta.  
     *
     * @param string $search
     * @return boolean
     */
    public function exists(string $search) : bool
    {
        $found = User::where(['email' => $search])->get();

        if ($found->isEmpty() == false) return true;

        return Accounts::account()->finder()->exists($search, User::TOKEN);
    }

    /**
     * Retorna uma pesquisa de usuário pelo campo "primeiro nome"
     * e "último nome". 
     *
     * @param string $search
     * @return Builder
     */
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