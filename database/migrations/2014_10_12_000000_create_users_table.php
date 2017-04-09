<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->unsignedInteger('sex');
            $table->string("phone",20);
            $table->date("birthday");
            $table->text("description");
            $table->string("address");
            $table->string("company");
            $table->unsignedInteger("relationships");
            $table->string("phone_parent",20);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('relationships')
                ->references('id')
                ->on('relationshipsTable');

            $table->foreign('sex')
                ->references('id')
                ->on('Sexs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
