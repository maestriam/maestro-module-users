<?php

namespace Maestro\Users\Tests;

use Illuminate\Support\Facades\Event;
use Maestro\Users\Support\Users;
use Maestro\Users\Entities\User;
use Maestro\Admin\Tests\TestCase as MainTestCase;
use Maestro\Users\Services\Events\UserDeleting;
use Maestro\Users\Support\Concerns\WithUserFactory;

class TestCase extends MainTestCase
{
    use WithUserFactory;

    public function setUp() : void
    {
        parent::setUp();
        $this->start();
        Event::fake([ UserDeleting::class ]);
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