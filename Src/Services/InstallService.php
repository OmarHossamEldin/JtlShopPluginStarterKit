<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Services;

use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\PostsTable;
use Plugin\JtlShopPluginStarterKit\Src\Database\Seeders\DatabaseSeeder;
use Plugin\JtlShopPluginStarterKit\Src\Support\Facades\Filesystem\Storage;

class InstallService
{

    /**
     * * it's migrate database tables  and create seeders when plugin installed
     */

    public function install()
    {
        $postsTable = new PostsTable();
        $postsTable->up();

        $runSeeder = new DatabaseSeeder();
        $runSeeder->run();
        Storage::load_resources();
    }

    public function unInstall()
    {
        $postsTable = new PostsTable();
        $postsTable->down();
        
        Storage::unload_resources();
    }
}
