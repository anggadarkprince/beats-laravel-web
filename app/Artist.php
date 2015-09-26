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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

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
    protected $fillable = ['name', 'avatar', 'about', 'birthday', 'birthplace', 'slug'];

    /**
     * get all artists record data and retrieve each 10 records
     *
     * @return mixed
     */
    public function allArtists()
    {
        return $this->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * get all artists data with information album total
     *
     * @return mixed
     */
    public function getArtistWithAlbum()
    {
        return $this
            ->selectRaw('artists.id, artists.name, avatar, artists.slug, title, cover, count(*) as album_total')
            ->leftJoin('albums', 'artists.id', '=', 'albums.artist')
            ->groupBy('artists.id')
            ->orderBy('artists.name', 'asc')
            ->paginate(15);
    }

    /**
     * find out an artist have many albums by 'artist' foreign key in 'songs' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albums()
    {
        return $this
            ->hasMany('App\Album', 'artist')
            ->selectRaw('*, albums.title as album_title, albums.slug as album_slug, count(songs.id) as song_total')
            ->leftJoin('songs', 'albums.id', '=', 'songs.album')
            ->orderBy('released', 'asc')
            ->groupBy('albums.id');
    }

    /**
     * find out an artist have many videos by 'artist' foreign key in 'videos' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('App\Video', 'artist');
    }

    /**
     * find out an artist have many posts by 'artist' foreign key in 'posts' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this
            ->hasMany('App\Post', 'artist')
            ->selectRaw('*, name as author')
            ->join('users', 'users.id', '=', 'posts.author')
            ->orderBy('posts.created_at', 'desc');
    }

}