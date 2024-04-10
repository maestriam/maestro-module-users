<?php

namespace Maestro\Users\Views\Pages;

use Illuminate\Contracts\View\View;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Admin\Support\Concerns\WithPaginationComponent;

class UserIndex extends MaestroView
{
    use SearchesUsers,
        DeletesUsers,        
        LivewireAlert,
        WithPaginationComponent;

    /**
     * Campo de busca para filtrar registros na tabela de usuarios
     *
     * @var string
     */
    public string $search = '';

    /**
     * {@inheritDoc}
     */
    protected string $view = 'users::pages.user-index';

    /**
     * Dados do usuário selecionado para realizar operações de exclusão
     *
     * @var User
     */
    protected User $selected;

    /**
     * Lista de eventos disparados neste componente
     *
     * @var array
     */
    public $listeners = [
        'deleteUser'
    ];

    /**
     * Redireciona para a pagina de lista de usuários
     *
     * @return void
     */
    public function goToCreate()
    {        
        return redirect()->route('maestro.users.create');
    }

    /**
     * Renderiza a view do componente
     * 
     * @return View
     */
    public function render() : View
    {
        $users = $this->searchUser();

        $collection = ['users' => $users];

        return $this->renderView($collection);
    }

    /**
     * Resgata os dados do usuário para realizar operações de exclusão
     *
     * @param User $user
     * @return User
     */
    private function selectUser(string $id) : User
    {
        $selected = $this->finder()->find($id);
        
        session()->put('selected-user', $selected);

        return $selected;
    }

    /**
     * Retorna os dados do usuário
     *
     * @return User
     */
    private function getSelected() : User
    {
        return session('selected-user');
    }

    /**
     * Dispara um evento para a exclusão de um usuário na plataforma
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id)
    {
        $user = $this->selectUser($id);
        $text = $this->getDeleteMessage($user);
    
        $this->alert('warning', __('users::modals.delete.title'), [            
            'timer'             => null,
            'toast'             => false,
            'reverseButtons'    => true,
            'showDenyButton'    => true,
            'showConfirmButton' => true,
            'html'              => $text,
            'position'          => 'center',
            'onConfirmed'       => 'deleteUser',
            'denyButtonText'    => __('users::modals.delete.deny'),
            'confirmButtonText' => __('users::modals.delete.confirm'),            
        ]);
    }

    /**
     * Retorna a mensagem do modal de exclusão de usuário, 
     * personalizada com o nome do usuário a ser excluído.
     *
     * @param User $user
     * @return string
     */
    private function getDeleteMessage(User $user) : string
    {
        $name = "{$user->firstName} {$user->lastName}";

        return sprintf(__('users::modals.delete.text'), $name);
    }

    /**
     * Retorna uma pesquisa de usuários pelo nome, sobrenome e e-mail
     *
     * @return void
     */
    private function searchUser() 
    {   
        return Users::user()->search($this->search)->paginate(10);
    }

    /**
     * Exclui um usuário da base de dados de forma permanente. 
     * 
     * @return void
     */
    public function deleteUser()
    {
        $user = $this->getSelected();

        $this->destroyer()->delete($user->id);

        return $this->alert("success", __('users::modals.deleted.title'), [
            "text"             => __('users::modals.deleted.text'),
            'position'         => 'bottom-end',
            'timerProgressBar' => true,
        ]);
    }    
}