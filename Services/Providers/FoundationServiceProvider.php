<?php

namespace Maestro\Users\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Maestro\Users\Services\Foundation\UserAuth;
use Maestro\Users\Services\Foundation\UserDestroyer;
use Maestro\Users\Services\Foundation\UserFinder;
use Maestro\Users\Services\Foundation\UserCreator;
use Maestro\Users\Services\Foundation\UserUpdater;

class FoundationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerSingletons();
    }

    private function registerSingletons()
    {
        $this->app->singleton(UserAuth::class);
        $this->app->singleton(UserDestroyer::class);
        $this->app->singleton(UserFinder::class);
        $this->app->singleton(UserCreator::class);
        $this->app->singleton(UserUpdater::class);
    }
}