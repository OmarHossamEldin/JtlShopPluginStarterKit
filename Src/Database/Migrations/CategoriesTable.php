<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class CategoriesTable
{
    public function run_up()
    {
        Schema::create('tec_see_categories', function (Table $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_categories');
    }
}
