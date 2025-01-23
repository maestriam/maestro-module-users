<?php

namespace Maestro\Users\Services\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Maestro\Users\Console\SetupCommand;
use Maestro\Users\Console\PopulateCommand;
use Maestro\Users\Http\Middleware\AuthenticatesUsers;
use Maestriam\Maestro\Foundation\Registers\FileRegister;
use Maestro\Users\Http\Rules\UniqueEmail;
use Maestro\Users\Services\Events\UserPurged;
use Maestro\Users\Support\Facades\UserFacade;

class MainServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $moduleName = 'Users';

    /**
     * @var string
     */
    protected $moduleNameLower = 'users';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerSeeds();
        $this->registerFacade();
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
     * Registra o facade de suporte, para fornecer
     * funcionalidades para outros módulos.
     */
    protected function registerFacade(): self
    {
        $this->app->bind('users', function () {
            return new UserFacade();
        });

        return $this;
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $file = 'Resources/config/config.php';

        $this->publishes([
            module_path($this->moduleName, $file) => config_path($this->moduleNameLower.'.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, $file), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath,
        ], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }

    private function registerSeeds(): self
    {
        $path = module_path($this->moduleName, '/Database/Seeders/');

        FileRegister::from($path);

        return $this;
    }

    private function registerMigrations()
    {
        $path = module_path($this->moduleName, 'Database/Migrations');

        $this->loadMigrationsFrom($path);
    }
}
