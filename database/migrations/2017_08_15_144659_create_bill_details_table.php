<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id')->unsigned();
            $table->integer('coa_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('vat_id')->unsigned()->nullable();
            $table->integer('vat_amount');
            $table->string('descriptions');
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('total');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
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
        Schema::drop('bill_details');
    }
}
