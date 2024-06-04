<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Entities\FactoryEntity;

trait WithUserFactory
{
    public function factory() : FactoryEntity
    {
        return app()->make(FactoryEntity::class);
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