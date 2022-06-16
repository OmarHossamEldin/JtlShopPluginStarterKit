<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Migration;
use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class EmailCredentialsTable extends Migration
{
    public function run_up()
    {
        Schema::create('tec_see_email_credentials', function (Table $table) {
            $table->id();
            $table->string('email')->unique('email');
            $table->string('mail_host');
            $table->string('username');
            $table->string('password');
            $table->string('port');
            $table->timestamps();
        });
    }

    public function run_down()
    {
        Schema::dropIfExists('tec_see_email_credentials');
    }
}
