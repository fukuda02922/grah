<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_ins', function (Blueprint $table) {
            $table->increments('log_id');
            $table->unsignedInteger('users_mem_no');
            $table->string('session_key', 20);
            $table->char('active', 1);
            $table->timestamps();

            $table->foreign('users_mem_no')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_ins');
    }
}
