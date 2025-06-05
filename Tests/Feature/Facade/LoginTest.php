<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Users\Entities\User;

class LoginTest extends TestCase
{
    public function testLoginUser()
    {
        $user = Users::factory()->request();

        $logged = Users::auth()->login($user->accountName, $user->password);

        $this->assertInstanceOf(User::class, $logged);
    }
}