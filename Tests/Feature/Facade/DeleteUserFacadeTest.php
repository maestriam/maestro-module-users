<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;

class DeleteUserFacadeTest extends TestCase
{
    public function testDeleteUser()
    {
        $request = Users::factory()->fromRequest();

        $user = Users::user()->create($request);

        $deleted = Users::user()->delete($user->id);

        $this->assertEquals(1, $deleted);
    }
}