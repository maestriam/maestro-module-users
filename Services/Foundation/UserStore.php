<?php

namespace Maestro\Users\Services\Foundation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maestro\Users\Entities\User;
use Maestro\Accounts\Support\Facades\Accounts;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Admin\Support\Concerns\HandlesRequests;

class UserStore 
{
    use HandlesRequests;

    /**
     * Undocumented variable
     *
     * @var StoreUserRequest
     */
    protected StoreUserRequest $request;

    public function __construct()
    {
        $this->request = new StoreUserRequest();
    }

    /**
     * Cria um novo usuário na base de dados.
     *
     * @param Request $input  
     * @return User             
     */
    public function create(array|StoreUserRequest $input) : User
    {   
        $this->guard($input);
        
        $data = $this->getInputData($input);
        
        return $this->store($data);            
    }

    /**
     * Recebe um model do usuário e armazena os dados enviados
     * pelo cliente.  
     *
     * @param User $user
     * @param object $data
     * @return User
     */
    private function store(object $data) : User
    {
        $user             = new User();
        $user->email      = $data->email;
        $user->last_name  = $data->lastName;
        $user->first_name = $data->firstName;
        $user->password   = $this->makePassword($data->password);
        
        $user->save();
        
        $this->createAccount($user, $data);

        return $user;
    }

    /**
     * Registra uma nova conta para o usuário.
     *
     * @param User $user
     * @return void
     */
    private function createAccount(User $user, object $request) : void
    {
        $name = $request->accountName;

        Accounts::account()->create($user, $name);
    }
    
    /**
     * Devolve a senha do usuário encriptado para ser salva no banco.  
     *
     * @return string
     */
    private function makePassword(string $password) : string
    {
        return Hash::make($password);
    }
}