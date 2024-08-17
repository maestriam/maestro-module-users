<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Users;

class GetMockUserFacadeTest extends TestCase
{
    public function testGetMockUser()
    {
        $user = Users::factory()->model();

        $this->assertNotNull($user->id);
    }

    public function testGetRequestUser()
    {
        $user = Users::factory()->request();

        $this->assertNotNull($user->accountName);
        $this->assertNotNull($user->password);
        $this->assertNotNull($user->password_confirmation);
    }
}