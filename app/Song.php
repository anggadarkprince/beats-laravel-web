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
    protected $fillable = [
        'title', 'lyrics', 'slug'
    ];

}