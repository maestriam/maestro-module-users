<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;

class UserSearchFacadeTest extends TestCase
{
    public function testSearchUser()
    {
        $user = Users::factory()->model();
        $full = "$user->firstName $user->lastName";

        $found = Users::finder()->search($full)->get();

        $this->assertNotNull($found->first());
        $this->assertEquals($user->firstName, $found->first()->firstName);
        $this->assertEquals($user->lastName, $found->first()->lastName);
    }
}