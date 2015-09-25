<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/16/2015
 * Time: 10:44 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'songs';
    protected $primaryKey = 'id';
    protected $fillable = ['album', 'title', 'lyrics', 'music', 'writer', 'duration', 'is_hit', 'slug'];

    public function getHitsSong()
    {
        $hits = $this->select('songs.id', 'songs.title as title', 'albums.title as album', 'name', 'duration', 'cover', 'artists.slug as artist_slug', 'albums.slug as album_slug', 'songs.slug as song_slug')
            ->where('is_hits', 1)
            ->orderBy('songs.title', 'asc')
            ->join('albums', 'albums.id', '=', 'songs.album')
            ->join('artists', 'artists.id', '=', 'albums.artist')
            ->take(10)
            ->get();

        return $hits;
    }

    public function album()
    {
        return $this->belongsTo('App\Album', 'album');
    }

}