<?php


namespace Maestro\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private string $source = "users::validations";

    
    public function authorize()
    {
        return true;
    }

    public function messages() : array
    {
        return [
            'email.required'              => __("{$this->source}.email.required"),
            'firstName.required'          => __("{$this->source}.firstName.required"),
            'lastName.required'           => __("{$this->source}.lastName.required"),
            'accountName.required'        => __("{$this->source}.accountName.required"),
            'accountName.accounts.unique' => __("{$this->source}.accountName.unique"),
            'password.required'           => __("{$this->source}.password.required"),
            'password.confirmed'          => __("{$this->source}.password.confirmed"),
        ];        
    }
}