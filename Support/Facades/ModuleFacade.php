<?php

namespace Maestro\Users\Support\Facades;

use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\FindsUsers;
use Maestro\Users\Support\Concerns\CreatesUsers;
use Maestro\Users\Support\Concerns\UpdatesUsers;
use Maestro\Users\Support\Concerns\HasUserFactory;

class ModuleFacade
{
    use FindsUsers,
        DeletesUsers,
        AuthUsers,
        CreatesUsers,
        UpdatesUsers,
        HasUserFactory;
}