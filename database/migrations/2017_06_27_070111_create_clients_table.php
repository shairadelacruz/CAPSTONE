<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->index()->unsigned()->nullable();
            $table->string('tin_number');
            $table->string('company_name');
            $table->string('legal_name');
            $table->string('address');
            $table->date('financial_year');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->string('code')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
