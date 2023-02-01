<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserAuth;

/**
 * Fornece funcionalidades para autenticação de usuários
 */
trait AuthUsers
{
    /**
     * Retorna o serviço com as RN's sobre autenticação de usuários. 
     *
     * @return UserAuth
     */
    public function auth() : UserAuth
    {
        return app()->make(UserAuth::class);
    }
}