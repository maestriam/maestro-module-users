<?php

namespace Maestro\Users\Entities;

use Maestro\Users\Contracts\UserFacade;
use Maestro\Users\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacadeEntity implements UserFacade
{
    /**
     * {@inheritdoc}
     */    
    public function user() : UserEntity
    {
        return new UserEntity();
    }

    /**
     * {@inheritdoc}
     */    
    public function auth() : AuthEntity
    {
        return new AuthEntity();
    }

    /**
     * {@inheritdoc}
     */
    public function factory() : FactoryEntity
    {
        return new FactoryEntity();
    }
}