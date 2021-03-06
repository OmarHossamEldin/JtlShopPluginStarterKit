<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class PostsTable
{
    public function up()
    {
        Capsule::schema()->create('posts', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body');
            $table->string('quantity');
            $table->foreignId('tec_see_category_id')->references('tec_see_categories');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('posts');
    }
}
