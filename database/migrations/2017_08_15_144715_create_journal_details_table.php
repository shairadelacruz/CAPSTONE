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
            $table->integer('vat_id')->nullable()->unsigned();
            $table->integer('coa_id')->unsigned();
            $table->integer('reference_no')->nullable()->unsigned();
            $table->string('descriptions')->nullable();
            $table->double('debit')->default(0); //nullable before
            $table->double('credit')->default(0); //nullable before
            $table->double('vat_amount')->default(0); //nullable before
            $table->foreign('journal_id')->references('id')->on('journals')->onDelete('cascade');
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
