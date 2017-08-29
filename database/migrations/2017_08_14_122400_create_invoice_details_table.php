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
            $table->integer('invoice_id')->unsigned();
            $table->integer('coa_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('vat_id')->unsigned();
            $table->integer('vat_amount');
            $table->string('descriptions');
            $table->integer('qty');
            $table->decimal('price');
            $table->decimal('total');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::drop('invoice_details');
    }
}
