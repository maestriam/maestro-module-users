<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;

class DeleteUserFacadeTest extends TestCase
{
    public function testDeleteUserById()
    {
        $user = Users::factory()->model();

        $deleted = Users::user()->delete($user->id);

        $this->assertEquals(1, $deleted);
    }

    public function testDeleteUserByModel()
    {
        $user = Users::factory()->model();

        $deleted = Users::user()->delete($user);

        $this->assertEquals(1, $deleted);
    }
}