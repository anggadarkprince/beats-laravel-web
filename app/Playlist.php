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
}