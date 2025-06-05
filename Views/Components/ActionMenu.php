<?php

namespace Maestro\Users\Views\Components;

use Livewire\Attributes\On;
use Maestro\Users\Entities\User;
use Maestro\Admin\Support\Enums\Livewire;
use Maestro\Users\Support\Enums\LivewireEnum;
use Maestro\Users\Support\Concerns\DeletesUsers;
use Maestro\Admin\Views\Components\OptionResource;

class ActionMenu extends OptionResource
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
        return $this->setUserId()->initRoutes();   
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
     * {@inheritDoc}
     */
    public function remove() : void
    {        
        $text = $this->deleteMessage();
        
        $title = __('users::modals.delete.title');
        
        $this->displayDeleteModalComponent($title, $text);
    }

    /**
     * Retorna o texto que será exibido no modal de exclusão
     * de entidades. 
     *
     * @return string
     */
    private function deleteMessage() : string
    {
        $text = __('users::modals.delete.text');
        
        return sprintf($text, $this->user->name());
    }

    /**
     * Evento executado quando o usuário clicar em confirmar
     * exclusão da demanda.  
     *
     * @return void
     */
    #[On(Livewire::OPTION_RESOURCE_ON_DELETE->value)]
    public function confirmed() : void
    {
        $this->destroyer()->delete($this->user->id);

        $this->deletedToast()->deletedEvent();
    }

    /**
     * Exibe um toast informando que o usuário foi excluído. 
     *
     * @return self
     */
    private function deletedToast() : self
    {
        $text  = __('users::modals.deleted.text');
        $title = __('users::modals.deleted.title');
        
        $this->showToast($text, $title);

        return $this;
    }

    /**
     * Dispara evento quando a usuário for excluído. 
     *
     * @return self
     */
    private function deletedEvent() : self
    {
        $event = LivewireEnum::ACTION_MENU_ON_DELETED->value;

        $this->dispatch($event, $this->user->id);

        return $this;
    }
}