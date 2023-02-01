<?php

namespace Maestro\Users\Tests;

use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Admin\Tests\TestCase as MainTestCase;

class TestCase extends MainTestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->start();
    } 

    public function tearDown() : void
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Popula o banco de dados com uma 
     * determinada quantidade de usuários.
     *
     * @param integer $count
     * @return void
     */
    protected function populate(int $count = 1) : void
    {
        for ($i=1; $i <= $count; $i++) { 
            Users::factory()->model();
        }
    }

}