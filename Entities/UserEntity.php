<?php

namespace Maestro\Users\Entities;

use Illuminate\Validation\Validator;
use Maestro\Users\Database\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Users\Http\Requests\UpdateUserRequest;
use Maestro\Users\Services\Foundation\UserSearch;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Support\Concerns\StoresUsers;
use Maestro\Users\Support\Concerns\UpdatesUsers;

class UserEntity
{
    use StoresUsers, 
        DeletesUsers, 
        SearchesUsers,
        UpdatesUsers;

    /**
     * {@inheritdoc}
     */
    public function create(array|StoreUserRequest $request) : User
    {
        return $this->creator()->create($request);
    }

    /**
     * {@inheritdoc}
     */
    public function validator(array|StoreUserRequest $request) : Validator
    {
        return $this->creator()->validator($request);
    }

    /**
     * {@inheritdoc}
     */
    public function isValid(array|StoreUserRequest $request) : bool
    {
        return $this->creator()->isValid($request);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int|User $user) : int
    {
        return $this->destroyer()->delete($user);
    }

    /**
     * {@inheritdoc}
     */
    public function all() : Collection
    {
        return $this->finder()->all();
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id) : ?User
    {
        return $this->finder()->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findOrFail(int $id) : User
    {
        return $this->finder()->findOrFail($id);
    }

    public function update(int $id, UpdateUserRequest|array $request) : User
    {
        return $this->updater()->update($id, $request);
    }

    /**
     * {@inheritDoc}
     */
    public function search(string $term) 
    {
        $searcher = new UserSearch();

        return $searcher->search($term);
    }
}