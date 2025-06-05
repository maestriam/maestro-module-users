<?php

namespace Maestro\Users\Views\Pages;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Entities\User;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Admin\Support\Concerns\WithPaginationComponent;
use Maestro\Users\Support\Enums\LivewireEnum;

class UserIndex extends MaestroView
{
    use SearchesUsers,
        WithPaginationComponent;    

    /**
     * Campo de busca para filtrar registros na tabela de usuarios
     *
     * @var string
     */
    #[Url(as: 'q', except: '')]
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
    #[On(LivewireEnum::ACTION_MENU_ON_DELETED->value)]
    public function render() : View
    {
        $users = $this->searchUser();

        $collection = ['users' => $users];

        return $this->renderView($this->view, $collection);
    }

    /**
     * Retorna uma pesquisa de usuários pelo nome, sobrenome e e-mail
     *
     * @return void
     */
    private function searchUser() 
    {   
        if ($this->search != null) {
            $this->resetPage();
        }

        return $this->finder()->search($this->search)->paginate(10);
    }  
}