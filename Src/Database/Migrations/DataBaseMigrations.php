<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Migration;

class DataBaseMigrations extends Migration
{
    public function run_up()
    {
        $this->call([
            PostsTable::class,
            PaymentApiCredentialsTable::class,
            TokenParametersTable::class,
            OrderLinksTable::class,
        ], 'up');
    }

    public function run_down()
    {
        $this->call([
            OrderLinksTable::class,
            TokenParametersTable::class,
            PaymentApiCredentialsTable::class,
            PostsTable::class,
        ], 'down');
    }
}
