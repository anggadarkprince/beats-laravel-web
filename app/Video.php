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
    protected $table = 'videos';
    protected $primaryKey = 'id';
    protected $fillable = ['artist', 'title', 'description', 'resource', 'poster', 'slug'];

    public function artist()
    {
        return $this->belongsTo('App\Artist', 'artist');
    }

    public function getAllVideo()
    {
        return $this->selectRaw("*, videos.slug as videoSlug")->join('artists', 'videos.artist', '=', 'artists.id')->paginate(10);
    }
}