<?php

namespace Maestro\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Fonte de mensagens do módulo
     * 
     * @var string
     */
    private string $source = 'users::validation';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'email'    => 'required|email',
        ];
    }

    public function messages() : array
    {
        return [
            'email.email'       => __("{$this->source}.email.email"),
            'email.required'    => __("{$this->source}.email.required"),
            'password.required' => __("{$this->source}.password.required"),
        ];
    }
}