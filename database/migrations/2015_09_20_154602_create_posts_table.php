<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist')->unsigned();
            $table->integer('author')->unsigned();
            $table->string('title', 100);
            $table->text('content', 250);
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('artist')->references('id')->on('artists')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
