<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Schema;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Table;

class PostsTable
{
    public function up()
    {
        Schema::create('tec_see_posts', function (Table $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_posts');
    }
}
