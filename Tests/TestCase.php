<?php

namespace Maestro\Users\Tests;

use Maestro\Users\Support\Facade\Users;
use Maestro\Admin\Tests\TestCase as MainTestCase;
use Maestro\Users\Support\Concerns\WithUserFactory;

class TestCase extends MainTestCase
{
    use WithUserFactory;

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
     * @return array
     */
    protected function populate(int $count = 1) : array
    {
        $collection = [];

        for ($i=1; $i <= $count; $i++) { 
            $collection[] = Users::factory()->model();
        }

        return $collection;
    }

}