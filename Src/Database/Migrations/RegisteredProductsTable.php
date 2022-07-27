<?php

namespace MvcCore\Jtl\Database\Migrations;

use MvcCore\Jtl\Database\Initialization\Schema;
use MvcCore\Jtl\Database\Initialization\Table;

class RegisteredProductsTable
{
    public function up()
    {
        Schema::create('tec_see_registered_products', function (Table $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_sent');
            $table->foreignId('tec_see_job_id')->references('tec_see_jobs')->nullable('tec_see_job_id');
            $table->string('tec_see_product_id')->nullable('tec_see_product_id');
            $table->string('jtl_id')->nullable('jtl_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tec_see_registered_products');
    }
}
