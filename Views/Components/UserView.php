<?php

namespace Maestro\Users\Views\Components;

use Maestro\Admin\Views\MaestroView;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;

class UserView extends MaestroView
{
    /**
     * Dados do usuário. 
     *
     * @var User|null
     */
    public ?User $user = null;

    /**
     * Caminho do arquivo de visualização do componente.
     *
     * @var string
     */
    protected string $view = 'users::components.user-view';

    /**
     * Inicializa os atributos ao iniciar o componente. 
     *
     * @param integer $id
     * @return void
     */
    public function mount(int $id) : void
    {
        $this->init()->setUser($id);
    }
    
    /**
     * Inicia os atributos principais do componente.
     *
     * @return self
     */
    private function init() : self
    {
        $this->cardTitle = __('users::cards.view-user');

        return $this;
    }

    /**
     * Recebe os dados do usuário para renderizar na tela
     *
     * @param integer $id
     * @return self
     */
    private function setUser(int $id) : self
    {
        $this->user = Users::user()->find($id);

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
        return $this->renderView();
    }
}