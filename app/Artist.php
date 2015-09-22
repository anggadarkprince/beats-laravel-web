<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 12:22 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artists';
    protected $primaryKey = 'id';

    public function getArtistWithAlbum()
    {
        $artists = Artist::selectRaw('artists.id, artists.name, avatar, artists.slug, title, cover, count(*) as album_total')
            ->leftJoin('albums', 'artists.id', '=', 'albums.artist')
            ->groupBy('artists.id')
            ->orderBy('artists.name', 'asc')
            ->paginate(15);

        return $artists;
    }

    public function albums()
    {
        return $this->hasMany('App\Album', 'artist')
            ->selectRaw('*, count(*) as song_total')
            ->leftJoin('songs', 'albums.id', '=', 'songs.album')
            ->orderBy('released', 'asc')
            ->groupBy('albums.id');
    }

    public function videos()
    {
        return $this->hasMany('App\Video', 'artist');
    }

    public function posts()
    {
        return $this->hasMany('App\Post', 'artist')
            ->selectRaw('*, name as author')
            ->join('users', 'users.id', '=', 'posts.author')
            ->orderBy('posts.created_at', 'desc');
    }

}