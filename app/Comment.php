<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/21/2015
 * Time: 1:14 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

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
    protected $fillable = ['user', 'post', 'comment'];

    /**
     * find out an post owned by who (artist)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post');
    }

    /**
     * get all comments join with related author 'users' table and retrieve each 10 records data
     *
     * @return mixed
     */
    public function allComments()
    {
        return $this
            ->select('*', 'comments.id as id', 'comments.created_at as created_at')
            ->join('users', 'comments.user', '=', 'users.id')
            ->orderBy('comments.created_at', 'desc')
            ->paginate(10);
    }

    /**
     * retrieve single comment find by id join with users table as commentator
     *
     * @param $id
     * @return mixed
     */
    public function singleComment($id)
    {
        return $this
            ->select('*', 'comments.id as id', 'comments.created_at as created_at')
            ->join('users', 'comments.user', '=', 'users.id')
            ->where('comments.id', $id)
            ->first();
    }
}