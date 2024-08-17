<?php

namespace Maestro\Users\Services\Events;

use Maestro\Users\Entities\User;
use Maestro\Accounts\Support\Facades\Accounts;

class DeletingUser
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->setUser($user)->deleteAccount();
    }

    private function setUser(User $user) : DeletingUser 
    {
        $this->user = $user;
        return $this;
    }
    
    private function deleteAccount() 
    {        
        $account = $this->user->account();

        if ($account == null) return;

        Accounts::account()->delete($account->name);
    }
}