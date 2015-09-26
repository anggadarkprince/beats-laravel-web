<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 12:24 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';

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
    protected $fillable = ['artist', 'title', 'cover', 'description', 'label', 'released', 'slug'];

    /**
     * get all albums in database join with parent table 'artists'
     *
     * @return mixed
     */
    public function allAlbums()
    {
        return $this
            ->select("*", "artists.slug as slugArtist", "albums.slug as slugAlbum", 'albums.created_at as created_at')
            ->join('artists', 'albums.artist', '=', 'artists.id')
            ->orderBy('albums.released', 'desc')
            ->paginate(10);
    }

    /**
     * find out an album owned by who (artist)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist');
    }

    /**
     * find out an album have many songs by 'album' foreign key in 'songs' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany('App\Song', 'album');
    }
}