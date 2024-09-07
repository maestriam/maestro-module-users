<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Entities\User;
use Maestro\Users\Database\Factories\UserFactory;

trait WithUserFactory
{
    public final function factory() : UserFactory
    {
        return app()->make(UserFactory::class);
    }    

    /**
     * Gera um usuário fake e inicia a sessão para a criação dos testes.
     *
     * @return ?User
     */
    public final function initSession() : User
    {
        return $this->factory()->login();
    }
}