<?php

use Illuminate\Database\Seeder;

class SongTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Song::class, 300)->create();
    }
}
