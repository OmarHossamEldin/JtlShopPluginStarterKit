<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Schema;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Table;

class OrderLinksTable
{
    public function run_up()
    {
        Schema::create('tec_see_order_links', function (Table $table) {
            $table->id();
            $table->string('order_id');
            $table->string('order_status');
            $table->string('order_link');
            $table->string('link_name');
            $table->string('order_method');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_order_links');
    }
}
