<?php

namespace Maestro\Users\Services\Events;
 
use Maestro\Users\Entities\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserDeleted
{
    use Dispatchable, SerializesModels;

    public User $user;
 
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}