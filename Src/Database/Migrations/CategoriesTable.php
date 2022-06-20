<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CategoriesTable
{
    public function run_up()
    {
        Capsule::schema()->create('tec_see_categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Capsule::schema()->dropIfExists('tec_see_categories');
    }
}
