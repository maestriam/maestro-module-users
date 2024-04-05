<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Tests\TestCase;

class FactoryUserFacadeTest extends TestCase
{
    /**
     * Deve retornar um mock de model do usuário para ser
     * utilizados para testes em outros módulos. 
     *
     * @return void
     */
    public function testCreateModelUser()
    {
        $expected = "1";

        $user = Users::factory()->model();

        $this->assertGreaterThan(0, $user->id);
        $this->assertEquals($user->id, $expected);
    }

    /**
     * Deve retornar um mock de request de criação de usuário,
     * já logado dentro do sistema. 
     *
     * @return void
     */
    public function testFakeLogin()
    {         
        $expected = "1";

        $user = Users::factory()->login();
        $logged = Users::auth()->isLogged();        

        $this->assertTrue($logged);
        $this->assertEquals($user->id, $expected);        
    }
}