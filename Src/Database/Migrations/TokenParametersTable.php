<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class TokenParametersTable
{
    public function run_up()
    {
        Schema::create('tec_see_token_parameters', function (Table $table) {
            $table->id();
            $table->string('token_name');
            $table->string('token_type');
            $table->string('token_expiration');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_token_parameters');
    }
}
