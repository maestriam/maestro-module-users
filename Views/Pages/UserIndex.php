<?php

namespace Maestro\Users\Views\Pages;

use Illuminate\Contracts\View\View;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Users\Support\Concerns\SearchesUsers;
use Maestro\Users\Support\Concerns\FiresUserDeleteModal;
use Maestro\Admin\Support\Concerns\WithPaginationComponent;

class UserIndex extends MaestroView
{
    use SearchesUsers,
        DeletesUsers,               
        FiresUserDeleteModal,
        WithPaginationComponent;

    /**
     * {@inheritDoc}
     */
    public string $search = '';

    /**
     * {@inheritDoc}
     */
    protected string $view = 'users::pages.user-index';

    public $listeners = ['removeUser'];

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
     * Dispara um evento para a exclusão de um usuário na plataforma
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id)
    {
        $params = ['userId' => $id];

        $this->fireDeleteModal($params, 'removeUser');
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
     * @param [type] $params
     * @return void
     */
    public function removeUser($params)
    {
        $values = (object) $params;

        $this->destroyer()->delete($values->userId);
    }
}