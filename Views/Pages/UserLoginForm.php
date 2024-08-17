<?php

namespace Maestro\Users\Views\Pages;

use Maestro\Admin\Views\MaestroView;
use Illuminate\Support\Facades\Validator;
use Maestro\Users\Http\Requests\LoginRequest;
use Maestro\Users\Support\Users;

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
     * Caminho de tela base de login.
     *
     * @var string
     */
    protected string $base = 'admin::pages.login';

    /**
     * Caminho do arquivo de formulário de login
     *
     * @var string
     */
    protected string $view = 'users::pages.user-login';

    /**
     * Rota que será redirecionado depois do login
     * 
     * @var string
     */
    private string $route = 'maestro.admin.home';

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

    # {-- Public Functions --}

    /**
     * Exibe a view do componente
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return $this->renderView();
    }

    /**
     * Summary of submit
     * 
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function submit()
    {
        $this->guard();

        if ($this->login()) {
            return $this->success();
        }

        return $this->failed();
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

    # {-- Protected Functions --}

    /**
     * Inicializa as regras para validação de formulário de login. 
     *
     * @return void
     */
    protected function startValidation()
    {
        $this->validation = new LoginRequest();

        $this->rules = $this->validation->rules();

        $this->messages = $this->validation->messages();
    }    

    # {-- Private Functions --}

    /**
     * Executa o login com os dados do usuário.
     * Caso o login e senha seja inválido, deve retornar false. 
     *
     * @return boolean
     */
    private function login() : bool 
    {
        $user = Users::auth()->login($this->email, $this->password);

        return ($user == null) ? false : true;
    }

    /**
     * Executa as regra de negócio em caso de sucesso no login.
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    private function success()
    {
        return redirect()->route($this->route);
    }

    /**
     * Executa as regra de negócio em caso de erro no login.
     *
     * @return void
     */
    private function failed() : void
    {
        $message = __('users::alerts.login.invalid');
        
        session()->flash('message', $message);
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
}