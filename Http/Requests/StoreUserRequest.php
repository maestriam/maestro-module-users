<?php
namespace Maestro\Users\Http\Requests;

use Maestro\Users\Http\Rules\UniqueEmail;

class StoreUserRequest extends UserRequest
{   
    public function rules() : array
    {
        return [
            'firstName'   => ['required', 'string'],
            'lastName'    => ['required', 'string'],
            'password'    => ['required', 'confirmed'],
            'accountName' => ['required', 'accounts.unique'],
            'email'       => ['required', 'email', new UniqueEmail],
        ];
    }
}