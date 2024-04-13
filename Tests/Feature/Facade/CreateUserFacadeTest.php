<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Facade\Users;
use Maestro\Admin\Exceptions\InvalidRequestException;

class CreateUserFacadeTest extends TestCase
{
    public function testCreateUserByRequest()
    {
        $request = Users::factory()->fromRequest();

        $user = Users::user()->create($request);

        $this->assertEquals(1, $user->id);
    }

    public function testCreateUserByArray()
    {
        $array = Users::factory()->fromArray();

        $user = Users::user()->create($array);

        $this->assertEquals(1, $user->id);
    }

    public function testCreateUserWithoutRequest()
    {
        $this->expectException(InvalidRequestException::class);

        $user = Users::user()->create([]);
    }
}
