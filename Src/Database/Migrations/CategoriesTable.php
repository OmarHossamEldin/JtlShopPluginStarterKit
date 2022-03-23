<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Schema;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Table;

class CategoriesTable
{
    public function up()
    {
        Schema::create('tec_see_categories', function (Table $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_categories');
    }
}
