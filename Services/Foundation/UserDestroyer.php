<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Users\Entities\User;
use Maestro\Accounts\Support\Accounts;
use Maestro\Admin\Support\Concerns\Locomotive;
use Maestro\Users\Services\Events\UserDeleted;
use Maestro\Users\Support\Concerns\SearchesUsers;

class UserDestroyer 
{
    use Locomotive, SearchesUsers;

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

        $this->dispatchEvent($user);
        $this->deleteAccount($user);

        $user->delete();

        return $user->id;
    }
    
    /**
     * Dispara um evento sinalizando para todo o sistema que um
     * usuário será excluído.  
     * Com isso, os outros módulos devem
     * executar suas respectivas tarefas para eliminar quaisquer 
     * dados referente ao usuário específicado.  
     *
     * @param User $user
     * @return void
     */
    private function dispatchEvent(User $user)
    {            
        $this->event(UserDeleted::class, 'maestro.jobs.users.purged');
    
        UserDeleted::dispatch($user);                   
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