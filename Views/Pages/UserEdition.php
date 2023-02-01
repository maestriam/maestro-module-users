<?php

namespace Maestro\Users\Views\Pages;

use Livewire\Component;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;

class UserEdition extends Component
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $view = '';

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected string $base = '';

    public ?int $userId;

    /**
     * Evento executado ao iniciar os atributos.
     *
     * @return void
     */
    public function mount(int $id = null)
    {
        $this->initialize()->setUser($id);
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
     * Inicializa os atributos para ser 
     *
     * @return self
     */
    private function initialize() : self
    {
        $this->view = 'users::pages.user-edition';
        $this->base = 'admin::components.base-view';
        
        return $this;
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function render()
    {
        return view($this->view)->layout($this->base);
    }
}