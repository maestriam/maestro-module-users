<?php

namespace Maestro\Users\Support;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Maestro\Users\Services\Foundation\UserFinder finder()
 * @method static \Maestro\Users\Services\Foundation\UserFaker factory()
 * @method static \Maestro\Users\Services\Foundation\UserDestroyer destroyer()
 */
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