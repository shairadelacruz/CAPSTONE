<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('journal_id')->unsigned();
            $table->integer('vendor_id')->nullable()->unsigned();
            $table->integer('customer_id')->nullable()->unsigned();
            $table->string('reference_no');
            $table->string('description')->nullable();
            $table->double('debit')->nullable()->default(0);
            $table->double('credit')->nullable()->default(0);
            $table->double('vat_amount')->nullable();
            $table->integer('vat_id')->nullable();
            $table->integer('client_coa_id')->unsigned();
            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
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
        Schema::drop('journal_details');
    }
}
