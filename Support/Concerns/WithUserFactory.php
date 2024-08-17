<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Entities\User;
use Maestro\Users\Services\Foundation\UserFaker;

trait WithUserFactory
{
    public function factory() : UserFaker
    {
        return app()->make(UserFaker::class);
    }    

    /**
     * Gera um usuário fake e inicia a sessão para a criação dos testes.
     *
     * @return ?User
     */
    public function initSession() : User
    {
        return $this->factory()->login();
    }
}