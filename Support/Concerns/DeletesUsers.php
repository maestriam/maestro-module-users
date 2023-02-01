<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserDestroyer;

/**
 * Fornece funcionalidades para exclusão de usuários
 */
trait DeletesUsers
{
    /**
     * Retorna o serviço com as RN's sobre exclusão unitária ou 
     * exclusão em massa de usuários. 
     *
     * @return UserDestroyer
     */
    public function destroyer() : UserDestroyer
    {
        return app()->make(UserDestroyer::class);
    }
}