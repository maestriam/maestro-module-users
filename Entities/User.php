<?php

namespace Maestro\Users\Entities;

use Illuminate\Contracts\Support\Jsonable;
use Maestro\Users\Services\Events\DeletingUser;
use Maestro\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maestro\Accounts\Support\Concerns\HasAccount;
use Maestro\Admin\Support\Concerns\CamelAttributes;
use Maestro\Admin\Support\Concerns\HasSearch;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Maestro\Accounts\Support\Contracts\HasName;

class User extends Authenticatable implements HasName
{
    use CamelAttributes, HasFactory, HasAccount, HasSearch;
    
    protected $dispatchesEvents = [
        'deleting' => DeletingUser::class
    ];

    protected $searchable = [
        'email', 'first_name:last_name', 
    ];
        
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function name(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
