<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

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
