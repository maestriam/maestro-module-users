<?php

namespace Maestro\Users\Support\Facade;

use Illuminate\Support\Facades\Facade;

class Users extends Facade
{
    /**
     * Registra o nome do Facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor() 
    { 
        return 'users'; 
    }    
}