<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Accounts\Support\Accounts;
use Maestro\Users\Entities\User;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Http\Requests\UpdateUserRequest;
use Maestro\Admin\Support\Concerns\HandlesRequests;

class UserUpdater 
{
    use SearchesUsers, HandlesRequests;

    protected UpdateUserRequest $request;

    public function __construct()
    {
        $this->request = new UpdateUserRequest();
    } 

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param array|UpdateUserRequest $request
     * @return User
     */
    public function update(int $id, array|UpdateUserRequest $request) : User 
    {
        $this->guard($request);

        $user = $this->finder()->findOrFail($id); 
        $data = $this->toInput($request);

        $this->store($user, $data);

        return $user;
    }

    /**
     * Atualiza uma conta do usuário
     *
     * @param User $user
     * @return void
     */
    private function updateAccount(User $user, object $request) : void
    {
        $name = $request->accountName;

        if ($user->account()->name == $name) return;

        Accounts::account()->creator()->update($user, $name);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param object $data
     * @return User
     */
    public function store(User $user, object $data) : User
    {
        $user->email      = $data->email ?? $user->email;
        $user->first_name = $data->firstName ?? $user->firstName;
        $user->last_name  = $data->lastName ?? $user->lastName;

        $user->save();

        $this->updateAccount($user, $data);

        return $user;
    }
}