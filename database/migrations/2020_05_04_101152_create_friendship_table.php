<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendship', function (Blueprint $table) {
            $table->bigInteger('user_1_id')->unsigned();
            $table->foreign('user_1_id')->references('id')->on('users');
            $table->bigInteger('user_2_id')->unsigned();
            $table->foreign('user_2_id')->references('id')->on('users');
            $table->string("status");
            $table->primary(['user_1_id', 'user_2_id']);

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
        Schema::dropIfExists('friendship');
    }
}
