<?php

namespace Maestro\Users\Views\Pages;

use Livewire\Component;

class UserIndex extends Component
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $view;

    /**
     * Undocumented variable
     *
     * @var string
     */
    private string $base;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mount()
    {
        $this->view = 'users::pages.user-index';
        $this->base = 'admin::components.base-view';
    }

    /**
     * Renderiza a view do menu lateral
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view($this->view)->layout($this->base);
    }
}