<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class OrderLinksTable
{
    public function up()
    {
        Capsule::schema()->create('order_links', function ($table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('order_status');
            $table->string('order_link');
            $table->string('link_name');
            $table->string('order_method');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('order_links');
    }
}
