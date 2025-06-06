<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;

class CurrentUserTest extends TestCase
{
    public function testGetCurrentUser()
    {
        $user = Users::factory()->request();

        Users::auth()->login($user->email, $user->password);

        $current = Users::auth()->current();

        $this->assertNotNull($current);
    }

    public function testGetCurrentOrFail()
    {
        $user = Users::factory()->request();

        Users::auth()->login($user->email, $user->password);

        $current = Users::auth()->currentOrFail();

        $this->assertNotNull($current);
    }
}