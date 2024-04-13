<?php
namespace Maestro\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends UserRequest
{   
    public function rules() : array
    {
        return [
            'firstName'   => 'required|string',
            'lastName'    => 'required|string',
            'accountName' => 'required|accounts.unique',
            'email'       => 'required|email',
            'password'    => 'required|confirmed',
        ];
    }
}