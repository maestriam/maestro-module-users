<?php

namespace Maestro\Users\Services\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Maestro\Users\Entities\User;

class UserDeleting
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
    ) { 
        // dd($user);
    }
}