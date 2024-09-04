<?php

namespace Maestro\Users\Tests\Unit\Entities;

use Maestro\Users\Tests\TestCase;

class UserTest extends TestCase
{
    public function testNameFunction()
    {
        $user = $this->makeUser();
        $name = "{$user->firstName} {$user->lastName}";

        $this->assertEquals($name, $user->name());
    }

    public function testWrongName()
    {
        $user = $this->makeUser();
        $name = "{$user->lastName} {$user->firstName}"; 

        $this->assertNotEquals($name, $user->name());
    }
}