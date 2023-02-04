<?php

namespace Maestro\Users\Views\Pages;

use Maestro\Admin\Views\MaestroView;
use Illuminate\Support\Facades\Validator;
use Maestro\Users\Http\Requests\LoginRequest;

class UserLoginForm extends MaestroView
{
    /**
     * E-mail do usuário para login     
     * 
     * @var string
     */
    public ?string $email = null;

    /**
     * Senha do usuário
     * 
     * @var string
     */
    public ?string $password = null;

    /**
     * Rota que será redirecionado depois do login
     * 
     * @var string
     */
    private string $route = 'maestro.admin.home';

    /**
     * Caminho base
     *
     * @var string
     */
    protected string $base = 'admin::pages.login';

    /**
     * Caminho do arquivo
     *
     * @var string
     */
    protected string $view = 'users::pages.user-login';

    /**
     * Regras de validação do formulário. 
     *
     * @var array
     */
    private array $rules = [];

    /**
     * Mensagens de erro em caso de validação incorreta. 
     *
     * @var array
     */
    private array $messages = [];

    /**
     * Regras para validação do formulário de Login
     * 
     * @var \Maestro\Admin\Http\Requests\LoginRequest
     */
    private LoginRequest $validation;
   
    
    protected function startValidation()
    {
        $this->validation = new LoginRequest();

        $this->rules = $this->validation->rules();

        $this->messages = $this->validation->messages();
    }

    /**
     * Summary of submit
     * 
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function submit()
    {
        $this->guard();

        return redirect()->route($this->route);
    }

    /**
     * Verifica se o formulário de login foi preenchido corretamente.
     * Se sim, deve retornar true.
     * 
     * @return bool
     */
    public function guard() : array 
    {
        $this->startValidation();

        $request = $this->request();
        
        $validator = Validator::make(
            $request, $this->rules, $this->messages
        );     

        return $validator->validate();
    }

    /**
     * Retorna os dados preenchidos pelo usuário no formulário. 
     *
     * @return array
     */
    private function request() : array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    /**
     * Exibe a view do componente
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return $this->renderView();
    }
}