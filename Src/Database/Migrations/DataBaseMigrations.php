<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Migration;

class DataBaseMigrations extends Migration
{
    public function up()
    {
        $this->call([
            CategoriesTable::class,
            PostsTable::class,
            PaymentApiCredentialsTable::class,
            TokenParametersTable::class,
            OrderLinksTable::class,
            EmailCredentialsTable::class,
        ], 'up');
    }

    public function down()
    {
        $this->call([
            OrderLinksTable::class,
            TokenParametersTable::class,
            PaymentApiCredentialsTable::class,
            PostsTable::class,
            CategoriesTable::class,
            EmailCredentialsTable::class,
        ], 'down');
    }
}
