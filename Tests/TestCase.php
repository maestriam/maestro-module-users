<?php

namespace Maestro\Users\Tests;

use Maestro\Admin\Support\Concerns\Locomotive;
use Maestro\Users\Support\Users;
use Maestro\Admin\Tests\TestCase as MainTestCase;
use Maestro\Users\Entities\User;
use Maestro\Users\Support\Concerns\WithUserFactory;
use Maestro\Users\Support\Enums\EventsEnum;

class TestCase extends MainTestCase
{
    use WithUserFactory, Locomotive;

    public function setUp() : void
    {
        parent::setUp();
        $this->start();
        $this->clear(EventsEnum::USER_REMOVING->value);
    } 

    public function tearDown() : void
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Retorna um usuário fictício para executar testes.  
     *
     * @return User
     */
    protected function makeUser() : User
    {
        return Users::factory()->model();
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