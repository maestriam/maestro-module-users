<?php

namespace Maestro\Users\Support\Facades;

use Maestro\Users\Support\Enums\PageEnum;
use Maestro\Admin\Support\Concerns\ControlsPages;
use Maestro\Admin\Services\Foundation\PageControl;

class PageFacade
{
    use ControlsPages;

    /**
     * Undocumented function
     *
     * @return PageControl
     */
    public function userHome() : PageControl
    {
        $page = PageEnum::USER_HOME->value;

        return $this->pageControl()->page($page);
    }

    /**
     * Undocumented function
     *
     * @return PageControl
     */
    public function userInfo() : PageControl
    {
        $page = PageEnum::USER_INDEX->value;

        return $this->pageControl()->page($page);
    }
}