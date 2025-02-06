<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Users\Entities\User;
use Maestro\Accounts\Support\Accounts;
use Maestro\Users\Support\Concerns\SearchesUsers;

class UserDestroyer 
{
    use SearchesUsers;

    /**
     * Exclui um usuário da base de dados, de acordo com seu ID.  
     *
     * @param int $id
     * @return int
     */
    public function delete(int|User $target) : int
    {
        $id = is_int($target) ? $target : $target->id;

        $user = $this->finder()->findOrFail($id); 

        $user->delete();

        $this->deleteAccount($user);

        return $user->id;
    }

    /**
     * Remove os dados da conta do usuário. 
     *
     * @param User $user
     * @return boolean
     */
    private function deleteAccount(User $user) : bool
    {
        if (! $user->account()) return true;

        $accountId = $user->account()->id;

        return Accounts::account()->delete($accountId);
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