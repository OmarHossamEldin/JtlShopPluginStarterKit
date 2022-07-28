<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class CategoriesTable
{
    public function up()
    {
        Capsule::schema()->create('categories', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('categories');
    }
}
