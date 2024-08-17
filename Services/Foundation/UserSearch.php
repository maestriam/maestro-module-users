<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Users\Entities\User;

class UserSearch 
{
    public function search(string $term)
    {
        return User::search($term); 
    }
}