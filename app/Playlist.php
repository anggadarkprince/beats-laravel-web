<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 1:18 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    protected $primaryKey = 'id';
    protected $fillable = ['creator', 'list', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'creator');
    }

    public function songs()
    {
        return $this->hasMany('App\PlaylistSong', 'playlist')
            ->selectRaw('songs.id, songs.title as title, albums.title as album, name, duration, cover, artists.slug as artist_slug, albums.slug as album_slug, songs.slug as song_slug')
            ->join('songs', 'playlist_songs.song', '=', 'songs.id')
            ->join('albums', 'songs.album', '=', 'albums.id')
            ->join('artists', 'albums.artist', '=', 'artists.id')
            ->orderBy('songs.title', 'asc');
    }
}