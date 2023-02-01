<?php

namespace Maestro\Users\Http\Responses;

class UserResponse
{
    public string $firstName;

    public string $email;

    public function __construct($name, $email)
    {
        $this->firstName = $name;
        $this->email = $email;
    }

    /**
     * Retorna os dados do objeto como array
     *
     * @return array
     */
    public function toArray() : array
    {
        return [
            'firstName' => $this->firstName,
            'email'    => $this->email,
        ];
    }
}