<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract {

    // trait uses
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
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
    protected $fillable = ['name', 'email', 'password', 'gender', 'about', 'status', 'avatar', 'level', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * get all user type 'user', retrieve each 10 records data
     *
     * @return mixed
     */
    public function allUsers()
    {
        return $this
            ->where('level', 'USER')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * find out an user have many posts by 'author' foreign key in 'posts' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post', 'author');
    }

    /**
     * find out an user have many playlist by 'creator' foreign key in 'playlist' table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playlist()
    {
        return $this
            ->hasMany('App\Playlist', 'creator')
            ->selectRaw('*, playlist.id as id, count(playlist_songs.id) as song_total, playlist.created_at as created_at')
            ->leftJoin('playlist_songs', 'playlist.id', '=', 'playlist_songs.playlist')
            ->orderBy('list', 'asc')
            ->groupBy('playlist.id');
    }
}
