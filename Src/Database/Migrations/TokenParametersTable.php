<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class TokenParametersTable
{
    public function up()
    {
        Capsule::schema()->create('token_parameters', function ($table) {
            $table->increments('id');
            $table->string('token_name');
            $table->string('token_type');
            $table->string('token_expiration');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('token_parameters');
    }
}
