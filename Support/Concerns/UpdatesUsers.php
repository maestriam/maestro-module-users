<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserUpdater;

/**
 * Fornece funcionalidades para inserir/atualizar os 
 * dados do usuário.  
 */
trait UpdatesUsers
{
    /**
     * Retorna o serviço com as RN's sobre 
     * edição dos dados do usuário.  
     * 
     * @return UserCreator
     */
    public function updater() : UserUpdater
    {
        return app()->make(UserUpdater::class);
    }
}
