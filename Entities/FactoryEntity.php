<?php

namespace Maestro\Users\Entities;

use Maestro\Users\Database\Models\User;
use Maestro\Users\Database\Factories\UserFactory;
use Maestro\Users\Http\Requests\StoreUserRequest;
use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Concerns\StoresUsers;

class FactoryEntity extends UserFactory
{    
    use StoresUsers, AuthUsers;

    /**
     * Finge a criação de um novo usuário no banco de dados
     * e executa um login no sistema
     *
     * @return User
     */
    public function login() : User
    {
        $user = $this->request();

        return $this->auth()->login($user->email, $user->password);
    }

    /**
     * Registra um novo mock utilizando o serviço de criação de usuário
     * e retorna seu model. 
     *
     * @return User
     */
    public function model() : User
    {
        $request = $this->fromRequest();

        return $this->creator()->create($request);
    }

    /**
     * Registra um novo mock utilizando o serviço de criação de usuário
     * e retorna seu request. 
     *
     * @return StoreUserRequest
     */
    public function request() : StoreUserRequest
    {
        $request = $this->fromRequest();

        $this->creator()->create($request);

        return $request;
    }

    /**
     * Retorna um objeto com os dados do usuário para inserção.  
     *
     * @return StoreUserRequest
     */
    public function fromRequest() : StoreUserRequest
    {
        $request = new StoreUserRequest();

        $input = $this->fromArray();

        $request->merge($input);

        return $request;
    }

    /**
     * Retorna um array com dados válidos para criação de um usuário.  
     *
     * @return array
     */
    public function fromArray() : array
    {        
        $password = $this->faker->password();

        return [
            'firstName'             => $this->faker->firstName(),
            'lastName'              => $this->faker->lastName(),
            'accountName'           => $this->faker->userName(),   
            'email'                 => $this->faker->email(),
            'password'              => $password,
            'password_confirmation' => $password
        ];
    }

    
    public function populate(int $quantity = 10) : array 
    {
        $collection = [];

        for ($i=0; $i < $quantity; $i++) { 
            $collection[] = $this->model();
        }   

        return $collection;
    }
}