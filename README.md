Dynamic Side Menu

Dynamic Side Menu is a Laravel package designed to help you create and manage a customizable, dynamic sidebar menu for your application.

Installation

Step 1: Install the Package
To install the package via Composer, run the following command : composer require player/sidemenu

Step 2: Publish the Configuration File
After installing the package, publish the configuration file with:

php artisan vendor:publish --provider="Player\Sidemenu\Providers\SideMenuServiceProvider" --tag=config


Step 3: Install the Side Menu
Run the following command to install the necessary resources:
php artisan sidemenu:install

## Read More

For a detailed explanation and additional insights, check out the full article on Medium: [Dynamic Side Menu](https://medium.com/@hepinsavaliya2608/dynamic-side-menu-b7f46ed6b763).