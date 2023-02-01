<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Services\Foundation\UserFinder;

/**
 * Fornece funcionalidades para pesquisar/capturar
 * informações do usuário.  
 */
trait SearchesUsers
{
    /**
     * Retorna o serviço com as RN's sobre pesquisa e 
     * retorno de dados do usuário.  
     *
     * @return UserFinder
     */
    public function finder() : UserFinder
    {
        return app()->make(UserFinder::class);
    } 
}
