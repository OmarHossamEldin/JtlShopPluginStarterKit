<?php

namespace Plugin\JtlShopStarterKite\Src\Database\Migrations;

use Plugin\JtlShopStarterKite\Src\Database\Initialization\Schema;
use Plugin\JtlShopStarterKite\Src\Database\Initialization\Table;

class PostsTable  
{
    public function up()
    {
        $table =  new Table('posts');
        $table->id();
        $table->string('title');
        $table->string('body');
        $table->timestamps();
        $table->primaryKey('id');
        Schema::create($table);
    }

    public function down()
    {
        Schema::dropIfExistsdrop('posts');
    }
}
