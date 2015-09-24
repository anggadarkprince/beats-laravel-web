<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 1:07 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post')
            ->selectRaw('*, comments.created_at as created_at')
            ->join('users', 'comments.user', '=', 'users.id')
            ->orderBy('comments.created_at', 'asc');
    }

    public function author()
    {
        return $this->belongsTo('App\user', 'author');
    }
}