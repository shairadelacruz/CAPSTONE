<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no');
            $table->string('description')->nullable();
            $table->double('debit')->nullable()->default(0);
            $table->double('credit')->nullable()->default(0);
            $table->double('vat_amount')->nullable();
            $table->integer('vat_id')->nullable();
            $table->integer('client_coa_id');
            $table->integer('vendor_id')->nullable();
            $table->integer('customer_id')->nullable();
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
        Schema::drop('journals');
    }
}
