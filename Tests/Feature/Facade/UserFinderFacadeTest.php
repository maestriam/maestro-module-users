<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Exceptions\UserNotFoundException;

class UserFinderFacadeTest extends TestCase
{
    public function testFindUser()
    {
        $user  = Users::factory()->model();

        $found = Users::finder()->find($user->id);

        $this->assertNotNull($found);
    }

    public function testUserNotFound()
    {
        $missing = Users::finder()->find(6548051038408);

        $this->assertNull($missing);
    }

    public function testFindUserOrFail()
    {
        $this->expectException(UserNotFoundException::class);

        Users::finder()->findOrFail(123553);
    }
}