<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_header_id')->unsigned();
            $table->integer('client_coa_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('vat_id')->unsigned();
            $table->integer('vat_amount');
            $table->string('description');
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('total');
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
        Schema::drop('invoice_details');
    }
}
