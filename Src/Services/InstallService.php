<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Services;

use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\DataBaseMigrations;
use Plugin\JtlShopPluginStarterKit\Src\Database\Seeders\DatabaseSeeder;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem\Storage;

class InstallService
{

    /**
     * * it's migrate database tables  and create seeders when plugin installed
     */

    public function install()
    {

        $databaseMigrations = new DataBaseMigrations;
        $databaseMigrations->run_up();

        $runSeeder = new DatabaseSeeder();
        $runSeeder->run();
        Storage::load_resources();
    }

    public function unInstall()
    {

        $databaseMigrations = new DataBaseMigrations;
        $databaseMigrations->run_down();

        Storage::unload_resources();
    }
}
