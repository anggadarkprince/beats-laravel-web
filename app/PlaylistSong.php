<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 1:28 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class PlaylistSong extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'playlist_songs';

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
    protected $fillable = ['playlist', 'song'];

    /**
     * find out a playlist_song record reference with one song in 'songs' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function song()
    {
        return $this->belongsTo('App\Song', 'song');
    }

    /**
     * find out a playlist_song record reference with on playlist in 'playlist' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playlist()
    {
        return $this->belongsTo('App\Playlist', 'playlist');
    }
}