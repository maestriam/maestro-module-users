<?php

namespace Maestro\Users\Tests\Feature\Components;

use Livewire\Livewire;
use Maestro\Users\Support\Users;
use Maestro\Users\Tests\TestCase;
use Maestro\Users\Support\Enums\LivewireEnum;
use Maestro\Users\Views\Components\ActionMenu;
use Maestro\Admin\Support\Enums\Livewire as AdminLivewire;

class ActionMenuTest extends TestCase
{
    public function testRenderComponent()
    {
        Livewire::test(ActionMenu::class, $this->params())
                ->assertStatus(200)
                ->assertSee(__('users::buttons.edit'))
                ->assertSee(__('users::buttons.delete'))
                ->assertSee(__('users::buttons.view'));
    }

    public function testShowDeleteModal()
    {
        Livewire::test(ActionMenu::class, $this->params())
                    ->call('remove')
                    ->assertDispatched('alert');
    }

    public function testClickConfirmDelete()
    {
        $params = $this->params();

        $onDeleted = LivewireEnum::ACTION_MENU_ON_DELETED->value;
        $onDelete  = AdminLivewire::OPTION_RESOURCE_ON_DELETE->value;

        Livewire::test(ActionMenu::class, $params)
                ->dispatch($onDelete)
                ->assertDispatched($onDeleted);

        $user = Users::finder()->find($params['user']->id);

        $this->assertNull($user);            
    }    

    public function testRoutes()
    {
        $params = $this->params();

        $test = Livewire::test(ActionMenu::class, $params);

        foreach(['edit', 'info'] as $destination) {

            $route = $this->route($params['user']->id,  $destination);

            $test->assertSeeHtml($route);
        }
    }

    private function route(int $userId, string $destination) : string
    {
        $url = "maestro.users.$destination";

        return route($url, ['id' => $userId]);
    }

    private function params() : array
    {
        return ['user' => $this->makeUser()];
    }
}