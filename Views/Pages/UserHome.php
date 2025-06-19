<?php

namespace Maestro\Users\Views\Pages;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Support\Concerns\AuthUsers;
use Maestro\Users\Support\Concerns\ControlsUsersPage;

class UserHome extends MaestroView
{
    use AuthUsers, 
        ControlsUsersPage;
    
    /**
     * {@inheritDoc}
     */
    protected string $view = 'users::pages.user-home';

    /**
     * {@inheritDoc}
     */
    public function render()
    {        
        return $this->renderView($this->view);
    }

    /**
     * Retorna o nome de todos os slots para a inserção 
     * de componentes enxertados dinâmicamente.  
     *
     * @return Collection
     */
    #[Computed]
    public function slots() : Collection
    {
        return $this->usersPage()->userHome()->components();
    }

    /**
     * Retorna as propriedades que serão compartilhadas com 
     * componentes renderizados dinâmicamente. 
     *
     * @return array
     */
    protected function props() : array
    {
        return [
            'id' => $this->auth()->current()->id
        ];
    }
}