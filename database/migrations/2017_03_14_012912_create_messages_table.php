<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('user_send')->unsigned()->index();
            $table->integer('user_receive')->unsigned()->index();
            $table->integer('state')->unsigned();
            $table->timestamps();

            $table->foreign('user_send')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('user_receive')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
