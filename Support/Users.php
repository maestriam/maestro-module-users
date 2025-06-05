<?php

namespace Maestro\Users\Support;

use Illuminate\Support\Facades\Facade;
use Maestro\Users\Support\Concerns\HasModuleName;

/**
 * @method static \Maestro\Users\Services\Foundation\UserFinder finder()
 * @method static \Maestro\Users\Services\Foundation\UserDestroyer destroyer()
 * @method static \Maestro\Users\Services\Foundation\UserAuth auth()
 * @method static \Maestro\Users\Services\Foundation\UserStore store()
 * @method static \Maestro\Users\Services\Foundation\UserUpdater updater()
 * @method static \Maestro\Users\Database\Factories\UserFactory factory()
 */
class Users extends Facade
{
    use HasModuleName;

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