<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class IsLoggedUserFacadeTest extends TestCase
{
    public function testIsLogged()
    {
        $user = Users::factory()->request();

        Users::auth()->login($user->accountName, $user->password);

        $logged = Users::auth()->isLogged();

        $this->assertTrue($logged);
    }
}
