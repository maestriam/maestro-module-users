<?php

namespace Maestro\Users\Views\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Maestro\Users\Support\Concerns\FiresUserDeleteModal;
use Maestro\Users\Support\Facade\Users;

class UserTable extends Component
{
    use WithPagination, 
        FiresUserDeleteModal;

    /**
     * Undocumented variable
     *
     * @var string
     */
    public string $search = '';

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

        return view('users::components.user-table', $collection);
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