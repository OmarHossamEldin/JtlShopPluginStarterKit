<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class PlansTable
{
    public function up()
    {
        Schema::create('tec_see_plans', function (Table $table) {
            $table->id();
            $table->string('product_name');
            $table->string('type');
            $table->string('count');
            $table->string('plan_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_plans');
    }
}
