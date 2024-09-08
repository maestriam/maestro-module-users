<?php

namespace Maestro\Users\Services\Foundation;

use Exception;
use Maestro\Users\Entities\User;
use Maestro\Accounts\Support\Accounts;
use Maestro\Users\Exceptions\UserNotFoundException;

class UserDestroyer 
{
    /**
     * Exclui um usuário da base de dados, de acordo com seu ID.  
     *
     * @param int $id
     * @return int
     */
    public function delete(int|User $target) : int
    {
        $user = $this->getUserOrFail($target);        

        $this->deleteAccount($user);
        
        $user->forceDelete();

        return $user->id;
    }

    private function getUserOrFail(int|User $target) : User
    {
        if (isset($target->id)) {
            return $target;
        }

        $user = User::find($target);

        if (! $user) {
            throw new UserNotFoundException($target);
        }

        return $user;
    }

    private function deleteAccount(User $user) : bool
    {
        if (! $user->account()) {
            return true;
        }

        $accId = $user->account()->id;

        return Accounts::account()->delete($accId);
    }

    /**
     * Remove uma lista de usuários   
     *
     * @param  array
     * @return bool 
     */
    public function destroy(array $users) : bool
    {
        foreach($users as $userId) {
            $this->delete($userId);
        }

        return true;
    }
}