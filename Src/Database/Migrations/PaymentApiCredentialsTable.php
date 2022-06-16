<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class PaymentApiCredentialsTable
{
    public function run_up()
    {
        Schema::create('tec_see_api_credentials', function (Table $table) {
            $table->id();
            $table->string('business_account');
            $table->string('client_id');
            $table->string('secret_key');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_api_credentials');
    }
}
