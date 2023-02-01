<?php

namespace Maestro\Users\Contracts;

use Maestro\Users\Database\Models\User;

interface AuthFacade
{
    /**
     * Tenta autenticar o usuário através de seu login 
     * ou seu username.  
     * Em caso de sucesso, deve retornar as informações do usuário.  
     * Em caso de falha, deve retornar nulo.  
     *
     * @param $login   
     * @param $password
     * @return ?User
     */
    public function login(string $login, string $password) : ?User;    
    
    /**
     * Verifica se o usuário está logado no sistema.  
     * Se sim, deve retornar true. Caso contrário, false.  
     * 
     * @return bool  
     */
    public function isLogged() : bool;
}