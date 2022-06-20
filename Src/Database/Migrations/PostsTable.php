<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class PostsTable
{
    public function run_up()
    {
        Capsule::schema()->create('tec_see_posts', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('body');
            $table->string('quantity');
            $table->foreignId('tec_see_category_id')->references('tec_see_categories');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Capsule::schema()->dropIfExists('tec_see_posts');
    }
}
