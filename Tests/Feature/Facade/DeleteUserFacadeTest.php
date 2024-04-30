<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;

class DeleteUserFacadeTest extends TestCase
{
    public function testDeleteUserById()
    {
        $user = Users::factory()->model();
        $account = $user->account()->name;

        $deleted = Users::user()->delete($user->id);
        $exists = Accounts::account()->isExists($account);

        $this->assertEquals(1, $deleted);
        $this->assertFalse($exists);
    }

    public function testDeleteUserByModel()
    {
        $user = Users::factory()->model();
        $account = $user->account()->name;

        $deleted = Users::user()->delete($user);
        $exists = Accounts::account()->isExists($account);

        $this->assertEquals(1, $deleted);
        $this->assertFalse($exists);
    }
}