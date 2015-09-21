<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(ArtistTableSeeder::class);
        $this->call(AlbumTableSeeder::class);
        $this->call(SongTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(PlaylistTableSeeder::class);
        $this->call(PlaylistSongTableSeeder::class);
        $this->call(VideoTableSeeder::class);

        Model::reguard();
    }
}
