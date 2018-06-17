<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article')->unsigned();
            $table->integer('user')->unsigned()->nullable();
            $table->string('type');
            $table->integer('shared')->default(0);
            $table->integer('left')->default(200);
            $table->ipAddress('ip')->nullable();
            $table->foreign('article')->references('id')->on('articles');
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('shareds');
    }
}
