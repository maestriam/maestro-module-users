<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class FindUserTest extends TestCase
{
    use SearchesUsers;

    public function testFindUser()
    {
        $model = Users::factory()->model();

        $user = $this->finder()->find($model->id);

        $this->assertInstanceOf(User::class, $user);
    }
}