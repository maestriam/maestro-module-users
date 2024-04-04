<?php

namespace Maestro\Users\Services\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Maestriam\Maestro\Foundation\Registers\FileRegister;
use Maestro\Users\Entities\FacadeEntity;
use Maestro\Users\Http\Middleware\AuthenticatesUsers;
use Maestro\Users\Views\Pages\UserForm;
use Maestro\Users\Views\Pages\UserIndex;
use Maestro\Users\Views\Pages\UserLoginForm;
use Maestro\Users\Views\Pages\UserView;

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
        $this->registerViewComponents();
        $this->registerMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
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

    /**
     * Registra o facade de suporte, para fornecer
     * funcionalidades para outros módulos.
     */
    protected function registerFacade(): self
    {
        $this->app->bind('users', function () {
            return new FacadeEntity();
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

    private function registerViewComponents()
    {
        Livewire::component('users.pages.view', UserView::class);
        Livewire::component('users.pages.form', UserForm::class);
        Livewire::component('users.pages.index', UserIndex::class);
        Livewire::component('users.pages.login', UserLoginForm::class);
    }

    private function registerMigrations()
    {
        $path = module_path($this->moduleName, 'Database/Migrations');

        $this->loadMigrationsFrom($path);
    }
}
