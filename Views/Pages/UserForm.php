<?php

namespace Maestro\Users\Views\Pages;

use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Support\Concerns\StoresUsers;
use Maestro\Users\Support\Concerns\UpdatesUsers;
use Maestro\Users\Support\Facade\Users;

class UserForm extends MaestroView
{
    use StoresUsers, 
        UpdatesUsers,
        SearchesUsers;

    /**
     * Arquivo de view do componente
     *
     * @var string
     */
    protected string $view = 'users::pages.user-form';

    /**
     * Nome do usuário
     *
     * @var string
     */
    public string $firstName = '';
    
    /**
     * Sobrenome do usuário
     *
     * @var string
     */
    public string $lastName = '';

    /**
     * Nome da conta do usuário. 
     * Deve ser única e não pode conter espaços. 
     * Também utilizado para fazer login.
     *
     * @var string
     */
    public string $accountName = '';

    /**
     * E-mail do usuário.
     * Também utilizado para fazer login.
     *
     * @var string
     */
    public string $email = '';

    /**
     * Senha do usuário.
     *
     * @var string
     */
    public string $password = '';

    /**
     * Confirmação de senha do usuário.
     *
     * @var string
     */
    public string $passwordConfirm = '';

    /**
     * Dados do usuário
     *
     * @var User|null
     */
    public ?User $user = null;

    /**
     * Id do usuário utilizado no modo edição. 
     *
     * @var integer|null
     */
    public ?int $userId = null;

    /**
     * Evento executado ao iniciar os atributos.
     *
     * @return void
     */
    public function mount(int $id = null) 
    {
        $this->setUser($id);

        if (! $this->isEdition()) return;

        $this->edit();
    }

    /**
     * Verifica se o formulário deve ser exibido 
     * no modo edição ou no modo criação.
     *
     * @return boolean
     */
    public function isEdition() : bool 
    {
        return ($this->userId == null) ? false : true;
    }

    /**
     * Carrega o formulário no modo edição.
     * Ao iniciar, deve carregar os dados do usuário no formulário 
     * e bloquear os campos de edição de senha e nome da conta.
     *
     * @param integer|null $id
     * @return self
     */
    public function edit() : self
    {
        if ($this->userId == null) return $this;

        $this->user = $this->finder()->findOrFail($this->userId);

        return $this->load($this->user);
    }

    /**
     * Carrega as informações de um usuário no formulário,
     * para edição. 
     *
     * @param User $user
     * @return self
     */
    public function load(User $user) : self
    {
        $this->email           = $user->email;
        $this->firstName       = $user->firstName;
        $this->lastName        = $user->lastName;
        $this->accountName     = $user->account()->name;
        $this->password        = $user->password;
        $this->passwordConfirm = $user->password; 

        return $this;
    }

    /**
     * Redireciona para a pagina de lista de usuários
     *
     * @return void
     */
    public function back()
    {        
        return redirect()->route('maestro.users.index');
    }
    
    /**
     * Salva as informações no banco de dados e retorna uma 
     * mensagem para o cliente.
     *
     * @return void
     */
    public function save() 
    {        
        $request = $this->getRequest();
            
        if ($this->isEdition()) {
            return $this->update($request);
        }

        return $this->create($request);
    }

    /**
     * Recebe os dados preenchidos e atualiza os 
     * dados de um usuário existente. 
     *
     * @param array $request
     * @return void
     */
    public function update(array $request) : void 
    {
        $this->updater()->update($this->userId, $request);

        session()->flash('message', 'Post successfully updated.');
    }

    /**
     * Recebe os dados preenchidos e cria um novo usuário. 
     *
     * @param array $request
     * @return void
     */
    public function create(array $request) : void
    {        
        $this->guard($request);

        $this->creator()->create($request);

        session()->flash('message', 'Post successfully created.');
    }

    /**
     * Executa a validação dos dados enviado pelo usuário.
     * Em caso de problema, deve retornar a chave do erro 
     * para a exibição na view. 
     *
     * @param array $request
     * @return void
     */
    private function guard(array $request) 
    {
        return $this->creator()->validator($request)->validate();
    }

    /**
     * Retorna a requisição com os dados para a criação/edição 
     * de um usuário. 
     *
     * @return array
     */
    public function getRequest() : array 
    {
        return [
            'email'                 => $this->email,
            'firstName'             => $this->firstName,
            'lastName'              => $this->lastName,
            'accountName'           => $this->accountName, 
            'password'              => $this->password,
            'password_confirmation' => $this->passwordConfirm
        ];
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return self
     */
    private function setUser(int $id = null) : self
    {
        if ($id == null) return $this;    

        $this->userId = $id;
        
        return $this;
    }

    /**
     * Renderiza o arquivo 
     *
     * @return void
     */
    public function render()
    {
        return $this->renderView();
    }
}