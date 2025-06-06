<?php

namespace Maestro\Users\Services\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Views\Pages\UserInfo;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserLoginForm;
use Maestro\Users\Views\Components\UserSelect;
use Maestro\Users\Views\Components\ActionMenu;
use Maestro\Users\Support\Enums\ComponentEnum;
use Maestro\Users\Support\Concerns\HasModuleName;
use Maestro\Admin\Support\Concerns\RegistersViews;

class ViewServiceProvider extends ServiceProvider
{
    use HasModuleName, 
        RegistersViews;

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        $this->init();
        $this->registerPages();
        $this->registerComponents();
    }    

    /**
     * {@inheritDoc}
     */
    protected function registerComponents() : void
    {        
        Livewire::component(ComponentEnum::USER_SELECT->value, UserSelect::class);
        Livewire::component(ComponentEnum::ACTION_MENU->value, ActionMenu::class);
    }

    /**
     * {@inheritDoc}
     */
    private function registerPages()
    {
        Livewire::component('users.pages.view', UserInfo::class);
        Livewire::component('users.pages.form', UserForm::class);
        Livewire::component('users.pages.index', UserIndex::class);        
        Livewire::component('users.pages.login', UserLoginForm::class);
    }
}