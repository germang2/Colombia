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
            $table->string('name');
            $table->string('lastname');
            $table->bigInteger('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->char('code', 23)->unique();
            $table->char('godfather', 23)->nullable();
            $table->integer('city');
            //$table->foreign('city')->references('id')->on('cities');
            //$table->foreign('godfather')->references('code')->on('users');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
