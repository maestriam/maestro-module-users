<?php

namespace Maestro\Users\Services\Foundation;

use Maestro\Admin\Support\Concerns\HandlesRequests;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Http\Requests\UpdateUserRequest;
use Maestro\Users\Support\Concerns\StorageFunctions;

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
        $data = $this->getInputData($request);

        $this->store($user, $data);

        return $user;
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
        $user->email     = $data->email ?? $user->email;
        $user->first_name = $data->firstName ?? $user->firstName;
        $user->last_name  = $data->lastName ?? $user->lastName;

        $user->save();

        return $user;
    }
}