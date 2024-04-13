<?php
namespace Maestro\Users\Http\Requests;


class UpdateUserRequest extends UserRequest
{
    public function rules() : array
    {
        return [
            'firstName'   => 'required|string',
            'lastName'    => 'required|string',
            'email'       => 'required|email',
            'password'    => 'required|confirmed',
            'accountName' => 'required|accounts.unique'
        ];
    }
}