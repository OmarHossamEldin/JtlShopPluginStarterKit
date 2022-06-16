<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class PostsTable
{
    public function run_up()
    {
        Schema::create('tec_see_posts', function (Table $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->string('quantity');
            $table->foreignId('tec_see_category_id')->references('tec_see_categories');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_posts');
    }
}
