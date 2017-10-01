<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('deadline');
            $table->string('name');
            $table->string('description');
            $table->integer('task_type');
            $table->integer('status')->default(0);
            $table->integer('revisions')->default(0);
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->integer('client_id')->index()->unsigned()->nullable();
            //$table->integer('log_id')->index()->unsigned()->nullable();
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
        Schema::drop('tasks');
    }
}
