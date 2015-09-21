<?php

use Illuminate\Database\Seeder;

class PlaylistSongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PlaylistSong::class, 500)->create();
    }
}
