<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Tests\TestCase;

class ExistsTest extends TestCase
{
    use SearchesUsers;

    public function testExistByEmail()
    {
        $user = $this->makeUser();

        $response = $this->finder()->exists($user->email);

        $this->assertTrue($response);
    }

    public function testExistByAccount()
    {
        $user = $this->makeUser();

        $response = $this->finder()->exists($user->account()->name);

        $this->assertTrue($response);
    }

    public function testExistWithWrongEmail()
    {
        $user = $this->makeUser();

        $user->email = 'not-exists@never-land.com';

        $response = $this->finder()->exists($user->email);

        $this->assertFalse($response);
    }
}