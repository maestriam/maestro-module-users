<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserFinder;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\SearchesUsers;

class GetAllUsersTest extends TestCase
{
    use SearchesUsers;

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