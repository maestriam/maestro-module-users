<?php

namespace Maestro\Users\Support\Facades;

use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Support\Concerns\StoresUsers;
use Maestro\Users\Support\Concerns\UpdatesUsers;
use Maestro\Users\Support\Concerns\WithUserFactory;

class UserFacade
{
    use SearchesUsers,
        DeletesUsers,
        AuthUsers,
        StoresUsers,
        UpdatesUsers,
        WithUserFactory;
}