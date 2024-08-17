<?php

namespace Maestro\Users\Contracts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maestro\Users\Entities\FactoryEntity;

interface UserFacade
{
    /**
     * Retorna os dados fakes de um usuário para ser utilizados 
     * em testes. 
     *
     * @return Factory
     */
    public function factory() : FactoryEntity;
}