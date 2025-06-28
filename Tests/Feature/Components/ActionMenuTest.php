<?php

namespace Maestro\Users\Tests\Feature\Components;

use Livewire\Livewire;
use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Enums\LivewireEnum;
use Maestro\Users\Views\Components\ActionMenu;
use Maestro\Admin\Support\Enums\LivewireEnum as AdminLivewire;

class ActionMenuTest extends TestCase
{
    public function testRenderComponent()
    {
        $params = $this->params();

        list($info, $edit) = $this->routes($params['user']->id);

        Livewire::test(ActionMenu::class, $params)
                ->assertStatus(200)
                ->assertSeeHtml($info)
                ->assertSeeHtml($edit)
                ->assertSee(__('users::buttons.view'))
                ->assertSee(__('users::buttons.delete'));
    }

    public function testClickConfirmDelete()
    {
        $params = $this->params();
        
        $id = $params['user']->id;

        $deleted = LivewireEnum::ACTION_MENU_ON_DELETED->value;
        $delete  = AdminLivewire::ACTION_MENU_ON_DELETE->value . ".$id";        
        
        Livewire::test(ActionMenu::class, $params)
                ->dispatch($delete)
                ->assertDispatched($deleted);
        
        $user = Users::finder()->find($id);

        $this->assertNull($user);            
    }    

    private function routes(int $id) : array
    {
        return [
            route("maestro.users.info", ['id' => $id]),
            route("maestro.users.edit", ['id' => $id]),
        ];
    }

    private function params() : array
    {
        return ['user' => $this->makeUser()];
    }
}