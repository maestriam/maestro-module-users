<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserStore;

/**
 * Fornece funcionalidades para inserir/atualizar os 
 * dados do usuário.  
 */
trait StoresUsers
{
    /**
     * Retorna o serviço com as RN's sobre criação e 
     * edição dos dados do usuário.  
     * 
     * @return UserStore
     */
    public function creator() : UserStore
    {
        return app()->make(UserStore::class);
    }
}
