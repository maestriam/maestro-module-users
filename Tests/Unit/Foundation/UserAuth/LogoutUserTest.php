<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserAuth;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class LogoutUserTest extends TestCase
{
    use AuthUsers;

    /**
     * Deve autenticar um novo usuário válido pelo e-mail e senha.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = Users::factory()->model();

        $this->auth()->login($user->email, $user->password);

        $this->auth()->logout();

        $current = $this->auth()->current();
        
        $this->assertNull($current);
    }
}