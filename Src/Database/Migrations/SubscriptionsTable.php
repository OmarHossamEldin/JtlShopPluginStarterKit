<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class SubscriptionsTable
{
    public function up()
    {
        Schema::create('tec_see_subscriptions', function (Table $table) {
            $table->id();
            $table->enum('status',['pending','active','suspended','canceled'])->notNullable('status');
            $table->string('subscripton_id');
            $table->string('plan_id');
            $table->string('start_time');
            $table->string('create_time');
            $table->string('customerId');
            $table->foreignId('tec_see_job_id')->references('tec_see_jobs')->nullable('tec_see_job_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_subscriptions');
    }
}
