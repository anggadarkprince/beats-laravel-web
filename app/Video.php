<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 1:31 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videos';

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
    protected $fillable = ['artist', 'title', 'description', 'resource', 'poster', 'slug'];

    /**
     * get all videos related by artist, retrieve each 10 records data
     *
     * @return mixed
     */
    public function allVideos()
    {
        return $this
            ->select('*', 'videos.slug as videoSlug', 'artists.slug as artistSlug', 'videos.created_at as uploaded_at')
            ->join('artists', 'videos.artist', '=', 'artists.id')
            ->orderBy('videos.created_at', 'desc')
            ->paginate(10);
    }

    /**
     * find out a song owned by who (artist)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist');
    }

}