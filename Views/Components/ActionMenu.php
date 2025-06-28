<?php

namespace Maestro\Users\Views\Components;

use Livewire\Attributes\On;
use Maestro\Users\Entities\User;
use Maestro\Admin\Support\Enums\Livewire;
use Maestro\Users\Support\Enums\LivewireEnum;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Admin\Views\Components\ActionMenu as BaseActionMenu;

class ActionMenu extends BaseActionMenu
{
    use DeletesUsers;

    /**
     * Dados do usuário selecionado para realizar operações
     *
     * @var User
     */
    public User $user;

    /**
     * {@inheritDoc}
     */
    public string $module = 'users';

    /**
     * Evento ao inicializar o componente do Livewire
     *
     * @return void
     */ 
    public function mount()
    {
        $this->setUserId()
             ->initModalText()
             ->initRoutes();   
    }

    /**
     * Define o Id da empresa para definição de rotas
     *
     * @return self
     */
    private function setUserId() : self
    {
        $this->id = $this->user->id;

        return $this;
    }

    /**
     * Define o texto que será exibido no modal de exclusão
     * de entidades. 
     *
     * @return self
     */
    private function initModalText() : self
    {
        $text = sprintf($this->modalText, $this->user->name());

        $this->modalText = $text;
        
        return $this;
    }

    /**
     * Evento executado quando o usuário clicar em confirmar
     * exclusão da demanda.  
     *
     * @return void
     */
    #[On(Livewire::ACTION_MENU_ON_DELETE->value .".{user.id}")]
    public function confirmed() : void
    {
        $this->destroyer()->delete($this->user->id);

        $this->deletionToast();

        $this->deletionEvent();
    }

    /**
     * Dispara evento quando a usuário for excluído. 
     *
     * @return self
     */
    private function deletionEvent() : self
    {
        $event = LivewireEnum::ACTION_MENU_ON_DELETED->value;

        $this->dispatch($event, $this->user->id);

        return $this;
    }
}