<?php

namespace Maestro\Users\Tests\Feature\Components;

use Livewire\Livewire;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;
use Maestro\Users\Views\Components\UserActionBox;

class UserActionBoxTest extends TestCase
{
    private string $viewAction = 'goToViewPage';

    private string $delAction = 'showDeleteModal';
    
    private string $editAction = 'goToEditionForm';


    public function testRenderComponent()
    {
        $action = "wire:click=\"%s()\"";

        $del  = sprintf($action, $this->delAction);
        $view = sprintf($action, $this->viewAction);
        $edit = sprintf($action, $this->editAction);

        Livewire::test(UserActionBox::class, $this->getParams())
            ->assertStatus(200)
            ->assertSeeHtml($del)
            ->assertSeeHtml($edit)
            ->assertSeeHtml($view)
            ->assertSee(__('users::buttons.edit'))
            ->assertSee(__('users::buttons.delete'))
            ->assertSee(__('users::buttons.view'));
    }

    public function testShowDeleteModal()
    {
        Livewire::test(UserActionBox::class, $this->getParams())
                    ->call($this->delAction)
                    ->assertDispatched('alert');
    }

    public function testDispatchEventDeleteUser()
    {
        $expected = 'user-deleted';
        $command  = 'user-delete-cmd';

        $user   = $this->getUser();
        $params = ['user' => $user];
        $found  = Users::user()->find($user->id);

        $this->assertNotNull($found);

        Livewire::test(UserActionBox::class, $params)
            ->dispatch($command)
            ->assertDispatched('alert')
            ->assertDispatched($expected);

        $deleted = Users::user()->find($user->id);

        $this->assertNull($deleted);
    }    

    public function testGoToEditionForm()
    {
        $user   = $this->getUser();
        $params = ['user' => $user];
        $route  = route('maestro.users.edit', ['id' => $user->id]);

        Livewire::test(UserActionBox::class, $params)
            ->call($this->editAction)
            ->assertRedirect($route);
    }

    public function testGoToViewPage()
    {
        $user   = $this->getUser();
        $params = ['user' => $user];
        $route  = route('maestro.users.view', ['id' => $user->id]);

        Livewire::test(UserActionBox::class, $params)
            ->call($this->viewAction)
            ->assertRedirect($route);
    }

    private function getParams() : array
    {
        return ['user' => $this->getUser()];
    }

    private function getUser() : User
    {
        return Users::factory()->model();
    }
}