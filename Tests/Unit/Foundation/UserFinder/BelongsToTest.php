<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use Maestro\Users\Support\Concerns\FindsUsers;
use Maestro\Users\Tests\TestCase;

class BelongsToTest extends TestCase
{
    use FindsUsers;

    public function testBelongsTo()
    {
        $user = $this->makeUser();

        $belongs = $this->finder()->belongsTo($user->email, $user->id);

        $this->assertTrue($belongs);
    }

    public function testDontBelongsTo()
    {
        $user = $this->makeUser();

        $belongs = $this->finder()->belongsTo($user->email, 508654184);

        $this->assertFalse($belongs);
    }
}