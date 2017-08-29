<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoasClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_coa', function (Blueprint $table) {
            //
            $table->integer('client_id');
            $table->integer('coa_id');
            $table->double('amount')->nullable();
            $table->primary(['coa_id', 'client_id']);
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
        Schema::table('client_coa', function (Blueprint $table) {
            //
            Schema::drop('client_coa');
        });
    }
}
