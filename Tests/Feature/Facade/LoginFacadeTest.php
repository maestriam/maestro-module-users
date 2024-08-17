<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Users\Database\Models\User;

class LoginFacadeTest extends TestCase
{
    public function testLoginUser()
    {
        $user = Users::factory()->request();

        $logged = Users::auth()->login($user->accountName, $user->password);

        $this->assertInstanceOf(User::class, $logged);
    }
}