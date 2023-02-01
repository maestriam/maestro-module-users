<?php

namespace Maestro\Users\Entities;

use Maestro\Users\Contracts\AuthFacade;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\AuthUsers;

class AuthEntity implements AuthFacade
{
    use AuthUsers;

    /**
     * {@inheritdoc}
     */
    public function login(string $login, string $pswd) : ?User
    {
        return $this->auth()->login($login, $pswd);
    }

    /**
     * {@inheritdoc}
     */
    public function logout() : void
    {
        $this->auth()->logout();
    }    

    /**
     * {@inheritdoc}
     */
    public function isLogged() : bool
    {
        return $this->auth()->isLogged();
    }

    /**
     * {@inheritdoc}
     */
    public function current() : ?User
    {
        return $this->auth()->current();
    }

    /**
     * {@inheritdoc}
     */
    public function currentOrFail() : User
    {
        return $this->auth()->currentOrFail();
    }
}