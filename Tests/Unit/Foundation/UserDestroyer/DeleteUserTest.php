<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserDestroyer;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\DeletesUsers;

class DeleteUserTest extends TestCase
{
    use DeletesUsers;

    public function testDeleteUserById()
    {
        $user = $this->create();

        $deleted = $this->destroyer()->delete($user->id);      
        
        $this->assertEquals(1, $deleted);
    }

    public function testDeleteUserByModel()
    {
        $user = $this->create();

        $deleted = $this->destroyer()->delete($user);

        $this->assertEquals(1, $deleted);
    }

    private function create()
    {
        $request = Users::factory()->fromRequest();

        return Users::creator()->create($request);
    }
}