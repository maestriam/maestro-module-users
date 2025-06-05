<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserCreator;

/**
 * Fornece funcionalidades para inserir/atualizar os 
 * dados do usuário.  
 */
trait CreatesUsers
{
    /**
     * Retorna o serviço com as RN's sobre criação e 
     * edição dos dados do usuário.  
     * 
     * @return UserCreator
     */
    public function creator() : UserCreator
    {
        return app()->make(UserCreator::class);
    }
}
