<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use App\Models\User as FakeUser;
use Maestro\Accounts\Database\Models\Account;
use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\SearchesUsers;

class IsUserTest extends TestCase
{
    use SearchesUsers;

    public function testIsUser()
    {
        $user = $this->makeUser();

        $response = $this->finder()->isUser($user);

        $this->assertTrue($response);
    }

    public function testFakeUser()
    {
        $user = new FakeUser();

        $response = $this->finder()->isUser($user);

        $this->assertFalse($response);
    }

    public function testOtherInstance()
    {
        $account = new Account();

        $response = $this->finder()->isUser($account);

        $this->assertFalse($response);
    }
}