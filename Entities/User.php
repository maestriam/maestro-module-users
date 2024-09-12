<?php

namespace Maestro\Users\Entities;

use Illuminate\Contracts\Support\Jsonable;
use Maestro\Users\Services\Events\DeletingUser;
use Maestro\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maestro\Admin\Support\Concerns\CamelAttributes;
use Maestro\Admin\Support\Concerns\HasSearch;
use Maestro\Accounts\Support\Abstraction\Accountable;

class User extends Accountable
{
    use CamelAttributes, HasFactory,  HasSearch;
    
    protected $dispatchesEvents = [
        'deleting' => DeletingUser::class
    ];

    protected $searchable = [
        'email', 'first_name:last_name', 
    ];

    public function token(): string
    {
        return '88j4j8945jm9ggnm58vkd3ggfgg';
    }
        
    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function name(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
