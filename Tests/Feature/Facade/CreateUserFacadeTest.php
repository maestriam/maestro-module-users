<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;
use Maestro\Admin\Exceptions\InvalidRequestException;

class CreateUserFacadeTest extends TestCase
{
    public function testCreateUserByRequest()
    {
        $request = Users::factory()->fromRequest();

        $user = Users::creator()->create($request);

        $this->assertEquals(1, $user->id);
    }

    public function testCreateUserByArray()
    {
        $array = Users::factory()->fromArray();

        $user = Users::creator()->create($array);

        $this->assertEquals(1, $user->id);
    }

    public function testCreateUserWithoutRequest()
    {
        $this->expectException(InvalidRequestException::class);

        $user = Users::creator()->create([]);
    }
}
