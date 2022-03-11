<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Services;

use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\PostsTable;
use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\PaymentApiCredentialsTable;
use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\TokenParametersTable;
use Plugin\JtlShopPluginStarterKit\Src\Database\Migrations\OrderLinksTable;
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

        $paymentTable = new PaymentApiCredentialsTable;
        $paymentTable->up();

        $tokenTable = new TokenParametersTable;
        $tokenTable->up();

        $linksTable = new OrderLinksTable;
        $linksTable->up();

        $runSeeder = new DatabaseSeeder();
        $runSeeder->run();
        Storage::load_resources();
    }

    public function unInstall()
    {
        $postsTable = new PostsTable();
        $postsTable->down();

        $linksTable = new OrderLinksTable;
        $linksTable->down();

        $paymentTable = new PaymentApiCredentialsTable;
        $paymentTable->down();

        $tokenTable = new TokenParametersTable;
        $tokenTable->down();

        Storage::unload_resources();
    }
}
