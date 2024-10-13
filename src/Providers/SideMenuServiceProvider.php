<?php

namespace Player\Sidemenu\Providers;

use Illuminate\Support\ServiceProvider;
use Player\Sidemenu\Console\Commands\PublishSideMenu;
use Player\Sidemenu\Services\MenuService;

class SideMenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__ . '/../config/sidemenu.php' => config_path('sidemenu.php'),
        ], 'config');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Publish migration files if needed
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations/'),
        ], 'migrations');

        // Load the seeder
        $this->publishes([
            __DIR__ . '/../database/seeders/' => database_path('seeders/'),
        ], 'seeder');

        $this->publishes([
            __DIR__.'/../resources/views/sidebar.blade.php' => resource_path('views/components/sidebar.blade.php'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../Class/' => app_path('Models'),
        ], 'model');
        
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishSideMenu::class,
            ]);
        }

        $this->mergeConfigFrom(__DIR__ . '/../config/sidemenu.php', 'sidemenu');
    }
}
