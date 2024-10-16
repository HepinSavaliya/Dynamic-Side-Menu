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

        $modelNamespace = config('sidemenu.model_namespace','App\Models');
        $modelPath = app_path('Models/Menu.php');
        $this->publishModel($modelNamespace,$modelPath,$filesystem);

        $controllerNamespace = config('sidemenu.controller_namespace', 'App\Http\Controllers');
        $controllerPath = app_path('Http/Controllers/MenuController.php');
        $this->publishController($controllerNamespace, $controllerPath, $filesystem);

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

    protected function publishModel($modelNamespace,$modelPath, Filesystem $filesystem)
    {
        $modelStubPath = __DIR__ . '/../stubs/Menu.stub';

        $this->publishStub($modelStubPath, $modelPath, [
            '{{ controllerNamespace }}' => $modelNamespace,
            '{{ modelNamespace }}' => config('sidemenu.model_namespace', 'App\Models'),
        ], $filesystem);
    }


    protected function publishController($controllerNamespace, $controllerPath, Filesystem $filesystem)
    {
        $controllerStubPath = __DIR__ . '/../stubs/MenuController.stub';

        $this->publishStub($controllerStubPath, $controllerPath, [
            '{{ controllerNamespace }}' => $controllerNamespace,
            '{{ modelNamespace }}' => config('sidemenu.model_namespace', 'App\Models'),
        ], $filesystem);
    }

    protected function publishStub($stubPath, $destinationPath, array $replacements, Filesystem $filesystem)
    {
        if (!$filesystem->exists($destinationPath)) {
            if ($filesystem->exists($stubPath)) {
                $content = $filesystem->get($stubPath);

                $content = str_replace(array_keys($replacements), array_values($replacements), $content);

                $filesystem->ensureDirectoryExists(dirname($destinationPath));

                $filesystem->put($destinationPath, $content);
            }
        } 
    }

}
