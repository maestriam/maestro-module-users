<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class GetAllUserFacadeTest extends TestCase
{
    public function testGetAllUsers()
    {
        $count = 10;
        
        $this->populate($count);

        $all = Users::user()->all();

        $this->assertCount($count, $all);
    }

    public function testFindUser()
    {
        $model = Users::factory()->model();
        $user  = Users::user()->find($model->id);

        $this->assertInstanceOf(User::class, $user);
    }
}