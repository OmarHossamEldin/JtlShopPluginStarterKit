<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class PaymentApiCredentialsTable
{
    public function up()
    {
        Capsule::schema()->create('api_credentials', function ($table) {
            $table->increments('id');
            $table->string('business_account');
            $table->string('client_id');
            $table->string('secret_key');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('api_credentials');
    }
}
