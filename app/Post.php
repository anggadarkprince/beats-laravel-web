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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

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
    protected $fillable = ['artist', 'author', 'title', 'content', 'slug'];

    /**
     * get all posts related with authors and artists, retrieve each 10 records data
     *
     * @return mixed
     */
    public function allPosts()
    {
        return $this
            ->select('*', 'artists.name as artist', 'users.name as author', 'posts.slug as slug', 'artists.slug as artistSlug', 'artists.avatar as artistAvatar', 'users.avatar as authorAvatar', 'posts.created_at as created_at')
            ->join('artists', 'posts.artist', '=', 'artists.id')
            ->join('users', 'posts.author', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);
    }

    /**
     * find out a post have many comments by 'post' foreign key in 'comments' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this
            ->hasMany('App\Comment', 'post')
            ->selectRaw('*, comments.created_at as created_at')
            ->join('users', 'comments.user', '=', 'users.id')
            ->orderBy('comments.created_at', 'asc');
    }

    /**
     * find out a post written by who (user)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\user', 'author');
    }
}