<?php

namespace Player\Sidemenu\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Player\Sidemenu\Console\Commands\PublishSideMenu;
use Illuminate\Filesystem\Filesystem;

class SideMenuServiceProvider extends ServiceProvider
{
    public function boot(Filesystem $filesystem)
    {
        $this->publishes([
            __DIR__ . '/../config/sidemenu.php' => config_path('sidemenu.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations/'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders/' => database_path('seeders/'),
        ], 'seeder');

        $this->publishes([
            __DIR__.'/../resources/views/sidemenu/' => resource_path('views/sidemenu/'),
        ], 'views');

        $modelNamespace = config('sidemenu.model_namespace', 'App\Models');
        $this->publishModel($modelNamespace);

        $controllerPath = config('sidemenu.controller_namespace', 'App\Http\Controllers') . '\MenuController.php';
        $this->publishes([
            __DIR__ . '/../stubs/MenuController.stub' =>  $controllerPath,
        ], 'controllers');

        $this->replaceNamespaceInController($filesystem,$controllerPath);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
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

    protected function publishModel($namespace)
    {
        $modelPath = app_path(str_replace('\\', '/', $namespace));

        if (!File::exists($modelPath)) {
            File::makeDirectory($modelPath, 0755, true);
        }

        $this->publishes([
            __DIR__.'/../Class/' => $modelPath,
        ], 'model');
    }

    protected function replaceNamespaceInController(Filesystem $filesystem,$controllerPath)
    {        
        if ($filesystem->exists($controllerPath)) {
            $content = $filesystem->get($controllerPath);

            $content = str_replace(
                ['{{ controllerNamespace }}', '{{ modelNamespace }}'],
                [config('sidemenu.controller_namespace', 'App\Http\Controllers'), config('sidemenu.model_namespace', 'App\Models')],
                $content
            );

            $filesystem->put($controllerPath, $content);
        }
    }

}
