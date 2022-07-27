<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class SubscriptionLinksTable
{
    public function up()
    {
        Schema::create('tec_see_subscription_links', function (Table $table) {
            $table->id();
            $table->string('link');
            $table->string('type');
            $table->string('method');
            $table->foreignId('tec_see_subscription_id')->references('tec_see_subscriptions')->notNullable('tec_see_subscription_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_subscription_links');
    }
}
