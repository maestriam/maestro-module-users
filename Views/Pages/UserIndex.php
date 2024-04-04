<?php

namespace Maestro\Users\Views\Pages;

use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Support\Concerns\FiresUserDeleteModal;
use Maestro\Users\Support\Facade\Users;

class UserIndex extends MaestroView
{
    use WithPagination, 
        FiresUserDeleteModal;

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
        $users = $this->getUsers();

        $collection = ['users' => $users];

        return $this->renderView($collection);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function remove(string $id)
    {
        $params = ['userId' => $id];

        $this->fireDeleteModal($params, 'removeUser');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getUsers()
    {   
        return Users::user()->search($this->search)->paginate(10);
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function paginationView()
    {
        return 'users::partials.pagination';
    }

    public function removeUser($params)
    {
        $values = (object) $params;

        Users::user()->delete($values->userId);
    }
}