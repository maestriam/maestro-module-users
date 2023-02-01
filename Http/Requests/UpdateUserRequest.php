<?php
namespace Maestro\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'firstName'   => 'string',
            'lastName'    => 'string',
            'email'       => 'email',
            'password'    => 'confirmed',
        ];
    }

    public function messages() : array
    {
        return [
            'firstName.required'          => 'validation.firstName.required',
            'lastName.required'           => 'validation.lastName.required',
            'accountName.required'        => 'validation.username.required',
            'accountName.accounts.unique' => 'validation.username.unique',
            'email.required'              => 'validation.email.required',
            'password.required'           => 'validation.password.required',
            'password.confirmed'          => 'validation.password.confirmed',
        ];        
    }
}