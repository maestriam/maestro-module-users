<?php

namespace Maestro\Users\Views\Pages;

use Maestro\Admin\Views\MaestroView;

class UserHome extends MaestroView
{
    /**
     * {@inheritDoc}
     */
    protected string $view = 'users::pages.user-home';

    public function render()
    {        
        $this->emitUp('user_login', 'xxxxxxx');

        return $this->renderView();
    }
}