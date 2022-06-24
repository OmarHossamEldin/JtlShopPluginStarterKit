<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class PlanLinksTable
{
    public function up()
    {
        Schema::create('tec_see_plan_links', function (Table $table) {
            $table->id();
            $table->string('link');
            $table->string('type');
            $table->string('method');
            $table->string('plan_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_plan_links');
    }
}
