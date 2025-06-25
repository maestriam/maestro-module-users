<?php

namespace Maestro\Users\Views\Pages;

use Maestro\Users\Entities\User;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Support\Concerns\FindsUsers;
use Maestro\Users\Support\Concerns\ControlsUsersPage;

class UserInfo extends MaestroView
{
    use FindsUsers, 
        ControlsUsersPage;

    /**
     * Dados do usuário. 
     *
     * @var User
     */
    public User $user;

    /**
     * Caminho do arquivo de visualização do componente.
     *
     * @var string
     */
    protected string $view = 'users::pages.user-info';

    /**
     * Inicializa os atributos ao iniciar o componente. 
     *
     * @param integer $id
     * @return void
     */
    public function mount(int $id) : void
    {
        $this->setUser($id);
    }

    /**
     * Recebe os dados do usuário para renderizar na tela
     *
     * @param integer $id
     * @return self
     */
    private function setUser(int $id) : self
    {
        $this->user = $this->finder()->findOrFail($id);

        return $this;
    }

    /**
     * Renderiza a view do componente, usando o 
     * layout principal como base. 
     *
     * @return void
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
        return $this->usersPage()->userInfo()->components();
    }

    /**
     * Retorna as propriedades compartilhadas com os componentes
     * renderizados dinâmicamente. 
     *
     * @return array
     */
    public function props() : array
    {
        return ['id' => $this->user->id];
    }
}