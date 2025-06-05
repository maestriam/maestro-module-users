<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\FindsUsers;

class GetAllUsersTest extends TestCase
{
    use FindsUsers;

    /**
     * Deve retornar a quantidade de dados populada no banco de dados.
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $count = 10;

        $this->populate($count);

        $all = $this->finder()->all();

        $this->assertCount($count, $all);
    }
}