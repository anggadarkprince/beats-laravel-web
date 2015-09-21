<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_songs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('playlist')->unsigned();
            $table->integer('song')->unsigned();
            $table->timestamps();

            $table->foreign('playlist')->references('id')->on('playlist')->onDelete('cascade');
            $table->foreign('song')->references('id')->on('songs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playlist_songs');
    }
}
