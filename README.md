# Dynamic-Side-Menu


[![Latest Version on Packagist](https://img.shields.io/packagist/v/vendor/package-name.svg?style=flat-square)](https://packagist.org/packages/vendor/package-name)
[![Total Downloads](https://img.shields.io/packagist/dt/vendor/package-name.svg?style=flat-square)](https://packagist.org/packages/vendor/package-name)

A brief description of what your package does.

## Installation

You can install the package via composer:

```bash
composer require player/sidemenu

install sidemenu by running this command
php artisan sidemenu:install

make provider for sidemenu by running this command
php artisan make:provider SidebarServiceProvider

add below code in provider

<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share the menu tree variable with all views or specific views
        View::composer('layout.app', function ($view) { 
            $menuModel = new Menu();
            $menuTree = $menuModel->getMenuTree(); 
            $view->with('menuTree', $menuTree);
        });
    }
}

you can change layout.app as per your blade name

