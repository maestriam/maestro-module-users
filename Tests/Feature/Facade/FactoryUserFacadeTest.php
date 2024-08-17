<?php

namespace Maestro\Users\Tests\Feature\Facade;

use Maestro\Users\Entities\User;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Users\Support\Users;
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
        $expected = 1;
        $user = Users::factory()->model();

        $this->assertGreaterThan(0, $user->id);
        $this->assertEquals($user->id, $expected);
    }

    /**
     * Deve retornar um mock de um objeto request
     *
     * @return void
     */
    public function testFromRequest()
    {
        $request = Users::factory()->fromRequest();

        $this->assertInstanceOf(StoreUserRequest::class, $request);
    }

    /**
     * Deve retornar um usuário logado no sistema para testes
     *
     * @return void
     */
    public function testLogin()
    {
        $user = Users::factory()->login();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id, 1);
    }

    /**
     * Deve retornar um mock de um usuário já logado dentro do sistema. 
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