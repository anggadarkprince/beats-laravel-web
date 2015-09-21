<?php

use Illuminate\Database\Seeder;

class PlaylistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Playlist::class, 200)->create();
    }
}
