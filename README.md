Dynamic Side Menu

Dynamic Side Menu is a Laravel package designed to help you create and manage a customizable, dynamic sidebar menu for your application.

Installation
Step 1: Install the Package
To install the package via Composer, run:

composer require player/sidemenu

Step 2: Publish the Configuration File
After installing the package, publish the configuration file:


php artisan vendor:publish --provider="Player\Sidemenu\Providers\SideMenuServiceProvider" --tag=config
This will create the sidemenu.php config file where you can customize the following settings:

table_name: Define your menu table's name.
menu_columns: Required columns for the menu (non-editable).
extra_fields: Add any extra fields with their types.
controller_namespace & model_namespace: Customize the namespaces for controllers and models.
url: Redirect URL for the menu order change feature.
route_name: The route used to store menu reordering via AJAX.
Step 3: Install the Side Menu
Run the following command to install the package:


php artisan sidemenu:install
Step 4: Create the Sidebar Service Provider
Generate a service provider to manage the sidebar:


php artisan make:provider SidebarServiceProvider
Then, edit the generated SidebarServiceProvider as follows:


<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register any services.
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
        View::composer('layouts.app', function ($view) {
            $menuModel = new Menu();
            $menuTree = $menuModel->getMenuTree();

            $view->getFactory()->startPush('sidebar', view('components.sidebar', compact('menuTree'))->render());
        });
    }
}
Step 5: Modify Your Layout
In your main layout file (e.g., layouts.app), add the following line to render the sidebar:


@stack('sidebar')
Adjust the layout file name if necessary.

Step 6: Run Migrations
To create the necessary database tables, run:


php artisan migrate
Step 7: Seed Menu Data
To generate initial dynamic menu data, use the included seeder:

Review and modify the database/seeders/MenuSeeder.php file to fit your needs.

Register the MenuSeeder in the DatabaseSeeder.php file:


$this->call(MenuSeeder::class);
Run the seeder to insert the data:


php artisan db:seed
Conclusion
You’ve successfully set up the Dynamic Side Menu in your Laravel application. You can now manage your sidebar menu dynamically and customize it using the configuration, migration, and seeder files.

For further customization, refer to the configuration file and explore additional options available.

