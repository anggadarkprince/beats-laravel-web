<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('avatar')->default('noimage.jpg');
            $table->string('about', 250);
            $table->date('birthday');
            $table->string('birthplace', 100);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist')->unsigned();
            $table->string('title', 50);
            $table->string('cover');
            $table->string('description', 250);
            $table->string('label', 50);
            $table->date('released');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('artist')->references('id')->on('artists')->onDelete('cascade');
        });

        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album')->unsigned();
            $table->string('title', 50);
            $table->text('lyrics')->nullable();
            $table->string('writer', 100)->nullable();
            $table->string('music', 100)->nullable();
            $table->time('duration');
            $table->boolean('is_hits');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('album')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('songs');
        Schema::drop('albums');
        Schema::drop('artists');
    }
}
