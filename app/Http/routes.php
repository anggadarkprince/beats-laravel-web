<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Admin routes...
Route::group(['as' => 'admin::', 'middleware' => 'App\Http\Middleware\AdminMiddleware'], function () {
    Route::get('dashboard', ['as' => 'dashboard', function () {
        $page = 'Dashboard';
        return view('pages.dashboard',compact('page'));
    }]);
    Route::resource('artists', 'Management\ArtistController', [
        'except' => ['show']
    ]);
    Route::resource('albums', 'Management\AlbumController', [
        'except' => ['show']
    ]);
    Route::resource('songs', 'Management\SongController', [
        'except' => ['show']
    ]);
    Route::resource('videos', 'Management\VideoController', [
        'except' => ['show']
    ]);
    Route::resource('posts', 'Management\PostController',[
        'except' => ['show']
    ]);
    Route::resource('comments', 'Management\CommentController', [
        'only' => [
            'index', 'show', 'store', 'destroy'
        ]
    ]);
    Route::resource('feedback', 'Management\FeedbackController', [
        'only' => [
            'index', 'show', 'store', 'destroy'
        ]
    ]);
    Route::resource('users', 'Management\UserController', [
        'only' => [
            'index', 'destroy'
        ]
    ]);
});

// Authentication routes...
Route::get('auth/login', ['as' => 'public_sign_in', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'post_sign_in', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'private_sign_out', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'public_sign_up', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'post_sign_up', 'uses' => 'Auth\AuthController@postRegister']);

// Public routes...
get('/', ['as' => 'public_home', 'uses' => 'Frontend\PagesController@index']);
get('/hits', ['as' => 'public_hits', 'uses' => 'Frontend\PagesController@hits']);
get('/artist', ['as' => 'public_artists', 'uses' => 'Frontend\PagesController@artists']);
get('/artist/{name}', ['as' => 'public_artist', 'uses' => 'Frontend\PagesController@artist']);
get('/album/{name}/{album}', ['as' => 'public_album', 'uses' => 'Frontend\PagesController@album']);
get('/song/{name}/{album}/{song}', ['as' => 'public_song', 'uses' => 'Frontend\PagesController@song']);
get('/video', ['as' => 'public_video', 'uses' => 'Frontend\PagesController@video']);
get('/video/{slug}', ['as' => 'public_show_video', 'uses' => 'Management\VideoController@show']);
get('/about', ['as' => 'public_about', 'uses' => 'Frontend\PagesController@about']);
get('/post/{slug}', ['as' => 'public_post', 'uses' => 'Management\PostController@show']);
post('/comment/{slug}', ['as' => 'comment_store', 'uses' => 'Management\CommentController@store']);

// Authenticate user allowed...
Route::get('/playlist', ['as' => 'private_playlist', 'uses' => 'Management\PlaylistController@index']);
Route::get('/setting', ['as' => 'private_setting', 'uses' => 'Management\UserController@edit']);
Route::get('/{slug}', ['as' => 'private_profile', 'uses' => 'Management\UserController@show']);

// User playlist...
Route::bind('playlist', function($id){
    return \App\Playlist::find($id);
});
$router->resource('playlist', 'Management\PlaylistController', [
    'names' =>[
        'index'     => 'playlist',
        'show'      => 'playlist_show',
        'create'    => 'playlist_create',
        'edit'      => 'playlist_edit',
        'store'     => 'playlist_store',
        'update'    => 'playlist_update',
        'destroy'   => 'playlist_destroy',
    ]
]);

// Ajax song route handle...
post('song/playlist', ['as' => 'song_playlist_save', 'uses' => 'Management\SongController@saveToPlaylist']);
delete('song/playlist/{slug}', ['as' => 'song_playlist_delete', 'uses' => 'Management\SongController@deleteFromPlaylist']);

// User setting..
Route::bind('user', function($id){
    return \App\User::find($id);
});
$router->resource('user', 'Management\UserController', [
    'names' =>[
        'show'      => 'user_show',
        'edit'      => 'user_setting',
        'update'    => 'user_update',
    ],
    'only' => ['show', 'edit', 'update']
]);


