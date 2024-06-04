<?php

namespace Maestro\Users\Views\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Contracts\View\View;
use Maestro\Users\Database\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maestro\Users\Support\Concerns\DeletesUsers;

class UserActionBox extends Component
{
    use DeletesUsers, LivewireAlert;

    /**
     * Dados do usuário selecionado para realizar operações
     *
     * @var User|null
     */
    public ?User $user = null;
 
    /**
     * Renderiza o componente 
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render() : View
    {
        return view('users::components.user-action-box');
    }

    /**
     * Redireciona para a tela de edição de usuário
     *
     * @return mixed
     */
    public function goToEditionForm() : mixed
    {
        $route  = 'maestro.users.edit';
        $params = ['id' => $this->user->id];

        return redirect()->route($route, $params);
    }

    /**
     * Redireciona para a tela de visualização de usuário
     *
     * @return mixed
     */
    public function goToViewPage() : mixed
    {
        $route = 'maestro.users.view';
        $params = ['id' => $this->user->id];

        return redirect()->route($route, $params);
    }

    /**
     * Exibe um modal para exclusão de um usuário.  
     * Em caso de confirmação, dispara um evento para a execução da 
     * exclusão.  
     *
     * @return void
     */
    public function showDeleteModal()
    {
        $text = $this->getDeleteMessage($this->user);

        $this->alert('warning', __('users::modals.delete.title'), [            
            'timer'             => null,
            'toast'             => false,
            'reverseButtons'    => true,
            'showDenyButton'    => true,
            'showConfirmButton' => true,
            'html'              => $text,
            'position'          => 'center',
            'onConfirmed'       => 'user-delete-cmd',
            'denyButtonText'    => __('users::modals.delete.deny'),
            'confirmButtonText' => __('users::modals.delete.confirm'),            
        ]);
    }

    /**
     * Exclui um usuário da base de dados de forma permanente. 
     * 
     * @return void
     */
    #[On('user-delete-cmd')]
    public function deleteUser() : void
    {
        $this->dispatch('user-deleted');

        $this->destroyer()->delete($this->user);

        $this->alert("success", __('users::modals.deleted.title'), [
            "text"             => __('users::modals.deleted.text'),
            'position'         => 'bottom-end',
            'timerProgressBar' => true,
        ]);
    }

    /**
     * Retorna a mensagem do modal de exclusão de usuário, 
     * personalizada com o nome do usuário a ser excluído.
     *
     * @return string
     */
    private function getDeleteMessage() : string
    {
        $name = "{$this->user->firstName} {$this->user->lastName}";

        return sprintf(__('users::modals.delete.text'), $name);
    }
}