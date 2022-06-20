<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class PaymentApiCredentialsTable
{
    public function run_up()
    {
        Capsule::schema()->create('tec_see_api_credentials', function ($table) {
            $table->increments('id');
            $table->string('business_account');
            $table->string('client_id');
            $table->string('secret_key');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Capsule::schema()->dropIfExists('tec_see_api_credentials');
    }
}
