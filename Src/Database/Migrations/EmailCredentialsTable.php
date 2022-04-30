<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Database\Migrations;

use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Migration;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Schema;
use Plugin\JtlShopPluginStarterKit\Src\Database\Initialization\Table;

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
