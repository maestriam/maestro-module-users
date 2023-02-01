<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserAuth;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class LoginUserTest extends TestCase
{
    use AuthUsers;

    /**
     * Deve autenticar um novo usuário válido pelo e-mail e senha.
     *
     * @return void
     */
    public function testAuthenticateUserByEmail()
    {
        $user = Users::factory()->request();

        $logged = $this->auth()->login($user->email, $user->password);
        
        $this->assertInstanceOf(User::class, $logged);
    }

    /**
     * Deve autenticar um novo usuário válido pelo conta e senha.
     *
     * @return void
     */
    public function testAuthenticateUserByAccount()
    {
        $user = Users::factory()->request();

        $logged = $this->auth()->login($user->accountName, $user->password);

        $this->assertInstanceOf(User::class, $logged);
    }
}