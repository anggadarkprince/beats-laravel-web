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

/*
Route::bind('songs', function($slug){
    return \App\Song::whereSlug($slug)->first();
});

$router->resource('songs', 'SongsController', [
    'only' => [
        'index', 'show', 'edit', 'update'
    ]
]);

get('music', ['as' => 'songs_path', 'uses' => 'SongsController@index']);
get('music/create', ['as' => 'song_create_path', 'uses' => 'SongsController@create']);
get('music/{song}', ['as' => 'song_path', 'uses' => 'SongsController@show']);
get('music/{slug}/edit', ['as' => 'song_edit_path', 'uses' => 'SongsController@edit']);
patch('music/{slug}', ['as' => 'song_update_path', 'uses' => 'SongsController@update']);
post('music', ['as' => 'song_store_path', 'uses' => 'SongsController@store']);
delete('music/{slug}', ['as' => 'song_destroy_path', 'uses' => 'SongsController@destroy']);

$router->resource('people', 'PeopleController',[
    'names' =>[
        'index' => 'employee',
        'show' => 'person'
    ],
    'only' =>['index', 'show', 'destroy']
]);

*/

get('music/{slug}/edit', ['as' => 'song_edit_path', 'uses' => 'Management\SongController@edit']);
patch('music/{slug}', ['as' => 'song_update_path', 'uses' => 'Management\SongController@update']);
delete('music/{slug}', ['as' => 'song_destroy_path', 'uses' => 'Management\SongController@destroy']);

// Admin routes...
Route::group(['as' => 'admin::', 'middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'dashboard', function () {
        $page = 'Dashboard';
        return view('pages.dashboard',compact('page'));
    }]);
    Route::resource('artists', 'Management\ArtistController');
    Route::resource('albums', 'Management\AlbumController');
    Route::resource('songs', 'Management\SongController');
    Route::resource('videos', 'Management\VideoController');
    Route::resource('posts', 'Management\PostController');
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
Route::get('/setting', ['as' => 'private_setting', 'uses' => 'Management\UserController@setting']);
Route::get('/{slug}', [
    'as' => 'private_profile',
    'uses' => 'Management\UserController@show'
]);

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
post('song/playlist', ['as' => 'song_playlist_save', 'uses' => 'Management\SongController@saveToPlaylist']);
delete('song/playlist/{slug}', ['as' => 'song_playlist_delete', 'uses' => 'Management\SongController@deleteFromPlaylist']);

// User setting..
Route::bind('user', function($id){
    return \App\User::find($id);
});
$router->resource('user', 'Management\UserController', [
    'names' =>[
        'index'     => 'user',
        'show'      => 'user_show',
        'create'    => 'user_create',
        'edit'      => 'user_edit',
        'store'     => 'user_store',
        'update'    => 'user_update',
        'destroy'   => 'user_destroy',
        'setting'   => 'user_setting',
    ]
]);


