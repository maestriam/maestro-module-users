<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserAuth;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Facade\Users;

class IsLoggedUserTest extends TestCase
{
    use AuthUsers;

    /**
     * Deve autenticar um novo usuário válido pelo conta e senha.
     *
     * @return void
     */
    public function testUserIsLogged()
    {
        $user = Users::factory()->request();

        $this->auth()->login($user->accountName, $user->password);

        $logged = $this->auth()->isLogged();

        $this->assertTrue($logged);
    }
}