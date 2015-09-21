<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $level = array('ADMINISTRATOR','USER', 'USER', 'USER', 'USER', 'USER');
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'avatar' => 'avatar ('.rand(1,7).').jpg',
        'level' => $level[array_rand($level, 1)]
    ];
});

$factory->define(App\Artist::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'avatar' => 'avatar ('.rand(1,7).').jpg',
        'about' => $faker->paragraph,
        'birthday' => $faker->dateTime,
        'birthplace' => $faker->city.', '.$faker->country,
        'slug' => str_random(10)
    ];
});

$factory->define(App\Album::class, function (Faker\Generator $faker) {
    return [
        'artist' => rand(1,30),
        'title' => ucwords(implode(' ', $faker->words)),
        'cover' => 'cover ('.rand(1,55).').jpg',
        'description' => $faker->paragraph,
        'label' => ucfirst($faker->word),
        'released' => $faker->dateTime,
        'slug' => str_random(10)
    ];
});

$factory->define(App\Song::class, function (Faker\Generator $faker) {
    return [
        'album' => rand(1,100),
        'title' => ucwords(implode(' ', $faker->words)),
        'lyrics' => implode("<br><br>", $faker->paragraphs),
        'writer' => $faker->name,
        'music' => $faker->name,
        'duration' => $faker->time(),
        'is_hits' => rand(0, 1),
        'slug' => str_random(10)
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'artist' => rand(1,30),
        'author' => rand(1,50),
        'title' => ucwords(implode(' ', $faker->words)),
        'content' => implode("<br><br>", $faker->paragraphs),
        'slug' => str_random(10)
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user' => rand(1,50),
        'post' => rand(1,200),
        'comment' => $faker->paragraph
    ];
});

$factory->define(App\Playlist::class, function (Faker\Generator $faker) {
    return [
        'creator' => rand(1,50),
        'list' => rand(1,200),
        'description' => $faker->paragraph
    ];
});

$factory->define(App\PlaylistSong::class, function (Faker\Generator $faker) {
    return [
        'playlist' => rand(1,200),
        'song' => rand(1,300)
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        'artist' => rand(1,30),
        'title' => ucwords(implode(' ', $faker->words)),
        'description' => $faker->paragraph,
        'slug' => str_random(10)
    ];
});