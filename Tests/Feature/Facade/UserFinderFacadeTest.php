<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Exceptions\UserNotFoundException;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class UserFinderFacadeTest extends TestCase
{
    public function testFindUser()
    {
        $user  = Users::factory()->model();

        $found = Users::user()->find($user->id);

        $this->assertNotNull($found);
    }

    public function testUserNotFound()
    {
        $missing = Users::user()->find(6548051038408);

        $this->assertNull($missing);
    }

    public function testFindUserOrFail()
    {
        $this->expectException(UserNotFoundException::class);

        Users::user()->findOrFail(123553);
    }
}