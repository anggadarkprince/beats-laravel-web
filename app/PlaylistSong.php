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
    protected $table = 'playlist_songs';
    protected $primaryKey = 'id';
}