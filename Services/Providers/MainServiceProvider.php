<?php

namespace Maestro\Users\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Maestro\Users\Console\SetupCommand;
use Maestro\Users\Http\Rules\UniqueEmail;
use Illuminate\Support\Facades\Validator;
use Maestro\Users\Console\PopulateCommand;
use Maestro\Users\Support\Facades\ModuleFacade;
use Maestro\Admin\Support\Concerns\RegistersFacade;
use Maestro\Admin\Support\Concerns\RegistersDatabase;
use Maestro\Users\Http\Middleware\AuthenticatesUsers;
use Maestro\Users\Support\Concerns\HasModuleName;

class MainServiceProvider extends ServiceProvider
{
    use HasModuleName, 
        RegistersFacade,
        RegistersDatabase;

    /**
     * {@inheritDoc}
     */
    private string $facade = ModuleFacade::class;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {        
        $this->registerFacade();
        $this->registerSeeds();
        $this->registerMiddlewares();
        $this->registerMigrations();
        $this->registerCommands();
        $this->registerRules();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ViewServiceProvider::class);
        $this->app->register(FoundationServiceProvider::class);
    }

    public function registerMiddlewares()
    {
        $middlewares = [
            'users.auth' => AuthenticatesUsers::class,
        ];

        foreach ($middlewares as $key => $class) {
            $this->app->make('router')->aliasMiddleware($key, $class);
        }
    }

    private function registerRules()
    {        
        Validator::extend('users.email.unique', UniqueEmail::class);
    }

    /**
     * Registra os comandos específicos do módulo
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            SetupCommand::class,
            PopulateCommand::class
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
