<?php

namespace Maestro\Users\Services\Providers;

use Maestro\Users\Support\Concerns\HasModuleName;
use Maestro\Admin\Support\Concerns\RegistersRouters;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    use HasModuleName,
        RegistersRouters;

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
        $this->mapLiveRoutes();
    }
}
