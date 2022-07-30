<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow', function (Blueprint $table) {
            $table->id();
            $table->integer('follower_user_id')->nullable();
            $table->integer('following_user_id')->nullable();
            $table->unsignedBigInteger('following_page_id')->nullable();

            $table->foreign('follower_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('following_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('following_page_id')->references('id')->on('pages')->cascadeOnDelete();
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
        Schema::dropIfExists('follow');
    }
}
