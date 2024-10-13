<?php

namespace Player\Sidemenu\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PublishSideMenu extends Command
{
    // The name and signature of the command.
    protected $signature = 'sidemenu:install';

    // The console command description.
    protected $description = 'Publish the SideMenu package config, migrations, seeder and seed the database';

    public function handle()
    {
        // Publish config, migrations, seeder, views, and model
        $this->info('Publishing config...');
        Artisan::call('vendor:publish', ['--tag' => 'config']);
        $this->info(Artisan::output());

        $this->info('Publishing migrations...');
        Artisan::call('vendor:publish', ['--tag' => 'migrations']);
        $this->info(Artisan::output());

        $this->info('Publishing seeder...');
        Artisan::call('vendor:publish', ['--tag' => 'seeder']);
        $this->info(Artisan::output());

        $this->info('Publishing views...');
        Artisan::call('vendor:publish', ['--tag' => 'views']);
        $this->info(Artisan::output());

        $this->info('Publishing model...');
        Artisan::call('vendor:publish', ['--tag' => 'model']);
        $this->info(Artisan::output());

        $this->info('All publishing tasks completed successfully.');
    }
}
