<?php

namespace Maestro\Users\Support\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Maestro\Users\Entities\UserEntity user()
 * @method static \Maestro\Users\Entities\AuthEntity auth()
 * @method static \Maestro\Users\Entities\FactoryEntity factory()
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