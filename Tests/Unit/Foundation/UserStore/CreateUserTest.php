<?php

namespace Maestro\Users\Tests\Unit\Foundation\UserStore;

use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Concerns\StoresUsers;
use Maestro\Users\Support\Facade\Users;

class CreateUserTest extends TestCase
{
    use StoresUsers;

    /**
     * Deve criar um novo usuário ao passar um objeto do 
     * tipo StoreUserRequest com dados válidos para o serviço.
     *
     * @return void
     */
    public function testCreateUserPassingFormRequest()
    {        
        $request = Users::factory()->fromRequest();
        $account = $request->accountName;

        $user = $this->creator()->create($request);

        $this->assertEquals(1, $user->id);        
        $this->assertEquals($account, $user->account()->name);
    }

    /**
     * Deve criar multiplos usuários de forma correta ao passar
     * um StoreUserRequest com dados válidos para o serviço.  
     *
     * @return void
     */
    public function testCreateMultipleUsersPassingFormRequest()
    {
        for ($id=1; $id < 5; $id++) { 
            
            $request = Users::factory()->fromRequest();            
            $user = $this->creator()->create($request);

            $this->assertEquals($id, $user->id);
            $this->assertEquals($request->accountName, $user->account()->name);
        }
    }

    /**
     * Deve criar um usuário de forma correta ao passar
     * um array com dados válidos para o serviço. 
     *
     * @return void
     */
    public function testCreateUserPassingArray()
    {
        $request = Users::factory()->fromRequest();       
        $account = $request['accountName'];
        
        $user = $this->creator()->create($request);

        $this->assertEquals(1, $user->id);
        $this->assertEquals($account, $user->account()->name);
    }
}