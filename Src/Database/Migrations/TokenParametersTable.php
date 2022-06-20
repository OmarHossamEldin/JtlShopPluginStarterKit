<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class TokenParametersTable
{
    public function run_up()
    {
        Capsule::schema()->create('tec_see_token_parameters', function ($table) {
            $table->increments('id');
            $table->string('token_name');
            $table->string('token_type');
            $table->string('token_expiration');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Capsule::schema()->dropIfExists('tec_see_token_parameters');
    }
}
