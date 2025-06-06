<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Accounts\Support\Accounts;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;

class DeleteUserTest extends TestCase
{
    public function testDeleteUserById()
    {
        $user = Users::factory()->model();
        $account = $user->account()->name;

        $deleted = Users::destroyer()->delete($user->id);
        $exists = Accounts::account()->isExists($account);

        $this->assertEquals(1, $deleted);
        $this->assertFalse($exists);
    }

    public function testDeleteUserByModel()
    {
        $user = Users::factory()->model();
        $account = $user->account()->name;

        $deleted = Users::destroyer()->delete($user);
        $exists = Accounts::account()->isExists($account);

        $this->assertEquals(1, $deleted);
        $this->assertFalse($exists);
    }
}