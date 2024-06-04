<?php

namespace Maestro\Users\Views\Components;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Modelable;
use Maestro\Users\Exceptions\InvalidExcludedUserException;
use Maestro\Users\Support\Concerns\SearchesUsers;

class UserSelect extends Component
{
    use SearchesUsers;

    /**
     * Valores selecionados via select
     *
     * @var [type]
     */
    #[Modelable]
    public $selected = [];
    
    public $excludes = null; 

    /**
     * Lista de TODOS os usuários cadastrados
     * 
     * @todo Pensar em uma maneira de pegar apenas alguns usuários
     * @var Collection
     */
    private ?Collection $users = null;

    /**
     * Função executado antes de renderizar o componente. 
     *
     * @return void
     */
    public function mount()
    {
        $this->setExcludedUser($this->excludes)->setUsers();
    }

    /**
     * A
     *
     * @return void
     */
    #[On("user-select:refresh")]
    public function refresh(array $params)
    {        
        if (! isset($params['excludes'])) {
            throw new InvalidExcludedUserException();            
        }

        $this->setExcludedUser($params['excludes'])->setUsers();
    }

    /**
     * Recupera a lista de ID's dos usuários que não deverão 
     * ser exibidos no componente. 
     *
     * @param mixed $list
     * @return self
     */
    private function setExcludedUser(array|Collection $list) : self
    {
        $ids = [];
        
        foreach($list as $user) {
            $ids[] = $user->id ?? $user['id'];
        }

        $this->excludes = $ids;

        return $this;
    }

    /**
     * Define a lista de usuários 
     *
     * @return void
     */
    public function setUsers() : void
    {
        $this->users = $this->finder()->all()->except($this->excludes);
    }

    /**
     * Renderiza o componente
     *
     * @return void
     */
    # #[On('$refresh')]
    public function render()
    {
        return view('users::components.user-select');
    }
}