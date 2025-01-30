<?php

namespace Maestro\Users\Entities;

use Maestro\Admin\Support\Concerns\HasSearch;
use Maestro\Users\Database\Factories\UserFactory;
use Maestro\Admin\Support\Concerns\CamelAttributes;
use Maestro\Accounts\Support\Abstraction\Accountable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maestro\Users\Services\Events\UserDeleting;

class User extends Accountable
{
    use CamelAttributes, HasFactory,  HasSearch;

    const TOKEN = '88j4j8945jm9ggnm58vkd3ggfgg';

    protected $dispatchesEvents = [
        'deleting' => UserDeleting::class
    ];

    protected $searchable = [
        'email', 'first_name:last_name', 
    ];

    public function token(): string
    {
        return self::TOKEN;
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
