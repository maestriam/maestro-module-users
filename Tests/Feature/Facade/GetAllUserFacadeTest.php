<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Entities\User;

class GetAllUserFacadeTest extends TestCase
{
    public function testGetAllUsers()
    {
        $count = 10;
        
        $this->populate($count);

        $all = Users::finder()->all();

        $this->assertCount($count, $all);
    }

    public function testFindUser()
    {
        $model = Users::factory()->model();
        $user  = Users::finder()->find($model->id);

        $this->assertInstanceOf(User::class, $user);
    }
}