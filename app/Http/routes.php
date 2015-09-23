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

// Authentication routes...
Route::get('auth/login', ['as' => 'public_sign_in', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'post_sign_in', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'public_sign_out', 'uses' => 'Auth\AuthController@getLogout']);

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
get('/about', ['as' => 'public_about', 'uses' => 'Frontend\PagesController@about']);
get('/post/{slug}', ['as' => 'public_post', 'uses' => 'Frontend\PostController@show']);
post('/feedback/send_feedback', ['as' => 'send_feedback', 'uses' => 'Frontend\PagesController@auth']);

// Authenticate user allowed...
Route::get('profile', [
    'as' => 'private_profile',
    'middleware' => 'auth',
    'uses' => 'Management\UsersController@show'
]);