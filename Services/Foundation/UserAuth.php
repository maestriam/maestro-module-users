<?php

namespace Maestro\Users\Services\Foundation;

use Illuminate\Support\Facades\Hash;
use Maestro\Users\Database\Models\User;
use Illuminate\Support\Facades\Session;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Users\Exceptions\SessionUserNotFoundException;

class UserAuth 
{
    /**
     * Tenta autenticar o usuário através de seu login 
     * ou pelo nome da conta.  
     * Em caso de sucesso, deve retornar as informações do usuário.  
     * Em caso de falha, deve retornar nulo.  
     *
     * @param $login   
     * @param $password
     * @return ?User
     */
    public function login(string $login, string $password) : ?User
    {
        $user = $this->authByEmail($login, $password);
        
        if ($user != null) {
            return $user;
        }

        return $this->authByAccount($login, $password);
    }

    /**
     * Verifica se o usuário está logado no sistema.  
     * Se sim, deve retornar true. Caso contrário, false.  
     * 
     * @return bool  
     */
    public function isLogged() : bool
    {
        return (Session::has('user')) ? true : false;
    }

    /**
     * Destroi todos os dados do usuário na sessão, 
     * para sair do sistema.  
     *
     * @return void
     */
    public function logout() : void
    {
        Session::flush();
    }

    /**
     * Retorna os dados do usuário logado na sessão atual.
     *
     * @return User
     */
    public function current() : ?User 
    {
        return Session::get('user');
    }

    /**
     * Retorna os dados do usuário logado na sessão atual 
     * ou retorna uma exception.
     *
     * @return User
     */
    public function currentOrFail() : User
    {
        $user = $this->current();

        if (! $user) {
            throw new SessionUserNotFoundException();            
        }

        return $user;
    }

    /**
     * Tenta autenticar usando o e-mail como login.  
     * Em caso de sucesso, deve retornar as informações do usuário.  
     * Em caso de falha, deve retornar nulo.    
     * 
     * @param string $username
     * @param string $pswd 
     * @return ?User
     */
    private function authByAccount(string $accountName, string $pswd) : ?User
    {
        $account = Accounts::account()->find($accountName);

        if ($account == null) {
            return null;
        }

        $user = User::find($account->entity_id); 

        if (! $user || ! $this->isValidPassword($pswd, $user->password)) {
            return null;
        }
        
        $this->setUserInSession($user);

        return $user;
    }

    /**
     * Tenta autenticar usando o e-mail como login.  
     * Em caso de sucesso, deve retornar as informações do usuário.  
     * Em caso de falha, deve retornar nulo.   
     * 
     * @param string $email
     * @param string $pswd 
     * @return ?User
     */
    private function authByEmail(string $email, string $pswd) : ?User
    {
        $user = User::where('email', $email)->first();

        if (! $user || ! $this->isValidPassword($pswd, $user->password)) {
            return null;
        }

        $this->setUserInSession($user);

        return $user;
    }

    /**
     * Coloca as informações do usuário logado na sessão. 
     *
     * @param User $user
     * @return void
     */
    private function setUserInSession(User $user)
    {
        Session::put('user', $user);
    }

    /**
     * Retorna se a senha do usuário é válida. 
     *
     * @param string $pswd
     * @param string $checked
     * @return boolean
     */
    private function isValidPassword(string $pswd, string $hash)
    {
        return Hash::check($pswd, $hash);
    }
}