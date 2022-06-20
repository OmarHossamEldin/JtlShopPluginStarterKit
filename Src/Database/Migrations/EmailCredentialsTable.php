<?php

namespace MvcCore\Jtl\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class EmailCredentialsTable 
{
    public function run_up()
    {
        Capsule::schema()->create('tec_see_email_credentials', function ($table) {
            $table->increments('id');
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
        Capsule::schema()->dropIfExists('tec_see_email_credentials');
    }
}
