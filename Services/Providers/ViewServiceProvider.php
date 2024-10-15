<?php

namespace Maestro\Users\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Maestro\Users\Views\Components\EmailText;
use Maestro\Users\Views\Components\UserActionBox;
use Maestro\Users\Views\Components\UserSelect;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserLoginForm;
use Maestro\Users\Views\Pages\UserView;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPages();
        $this->registerComponents();
    }    

    private function registerComponents()
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