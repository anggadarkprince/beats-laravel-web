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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'songs';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['album', 'title', 'lyrics', 'music', 'writer', 'duration', 'is_hit', 'slug'];

    /**
     * get all songs related by albums and artist, retrieve each 10 records data
     *
     * @return mixed
     */
    public function allSongs()
    {
        return $this
            ->select('*', 'artists.name as artist', 'albums.title as album', 'artists.slug as slugArtist', 'albums.slug as slugAlbum', 'songs.slug as slugSong', 'songs.created_at as created_at')
            ->join('albums', 'songs.album', '=', 'albums.id')
            ->join('artists', 'albums.artist', '=', 'artists.id')
            ->orderBy('songs.created_at', 'desc')
            ->paginate(10);
    }

    /**
     * get greatest hit song related by albums and artist, just take 10 records data
     *
     * @return mixed
     */
    public function getHitsSong()
    {
        $hits = $this
            ->select('songs.id', 'songs.title as title', 'albums.title as album', 'name', 'duration', 'cover', 'artists.slug as artist_slug', 'albums.slug as album_slug', 'songs.slug as song_slug')
            ->where('is_hits', 1)
            ->orderBy('songs.title', 'asc')
            ->join('albums', 'albums.id', '=', 'songs.album')
            ->join('artists', 'artists.id', '=', 'albums.artist')
            ->take(10)
            ->get();

        return $hits;
    }

    /**
     * find out a song included by which album
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function album()
    {
        return $this->belongsTo('App\Album', 'album');
    }

}