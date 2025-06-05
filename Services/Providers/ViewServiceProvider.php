<?php

namespace Maestro\Users\Services\Providers;

use Livewire\Livewire;
use Maestro\Users\Views\Pages\UserForm;
use Illuminate\Support\ServiceProvider;
use Maestro\Users\Views\Pages\UserView;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserLoginForm;
use Maestro\Users\Views\Components\UserSelect;
use Maestro\Users\Support\Concerns\HasModuleName;
use Maestro\Users\Views\Components\UserActionBox;
use Maestro\Admin\Support\Concerns\RegistersViews;

class ViewServiceProvider extends ServiceProvider
{
    use HasModuleName, 
        RegistersViews;

    public function boot()
    {
        $this->init();
        $this->registerPages();
        $this->registerComponents();
    }    

    protected function registerComponents() : void
    {        
        Livewire::component('user-select', UserSelect::class);
        Livewire::component('user-action-box', UserActionBox::class);
    }

    private function registerPages()
    {
        Livewire::component('users.pages.view', UserView::class);
        Livewire::component('users.pages.form', UserForm::class);
        Livewire::component('users.pages.index', UserIndex::class);        
        Livewire::component('users.pages.login', UserLoginForm::class);
    }
}