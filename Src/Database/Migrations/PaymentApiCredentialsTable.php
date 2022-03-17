<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Schema;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Table;

class PaymentApiCredentialsTable
{
    public function up()
    {
        Schema::create('tec_see_api_credentials', function (Table $table) {
            $table->id();
            $table->string('business_account');
            $table->string('client_id');
            $table->string('secret_key');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_api_credentials');
    }
}
