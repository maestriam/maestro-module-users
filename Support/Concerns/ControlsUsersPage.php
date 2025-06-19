<?php

namespace Maestro\Users\Support\Concerns;

use Maestro\Users\Support\Facades\PageFacade;

/**
 * Retorna o objeto para controlar dinâmicamente as
 * telas do módulo de Users. 
 */
trait ControlsUsersPage
{
    /**
     * Retorna o objeto para controlar dinâmicamente as
     * telas do módulo de Users. 
     *
     * @return PageFacade
     */
    public function usersPage() : PageFacade
    {
        return app()->make(PageFacade::class);
    }
}