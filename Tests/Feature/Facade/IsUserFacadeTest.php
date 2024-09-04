<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;

class IsUserFacadeTest extends TestCase
{
    public function testIsUser()
    {
        $user = $this->makeUser();
        
        $response = Users::finder()->isUser($user);

        $this->assertTrue($response);
    }
}