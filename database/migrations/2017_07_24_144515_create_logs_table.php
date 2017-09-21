<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference_no');
            $table->dateTime('date_received');
            $table->string('received_from');
            $table->string('document_path')>nullable();
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->integer('client_id')->index()->unsigned()->nullable();
            $table->integer('document_type_id')->index()->unsigned()->nullable();
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
        Schema::drop('logs');
    }
}
