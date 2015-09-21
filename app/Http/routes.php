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

get('/', ['as' => 'public_home', 'uses' => 'Frontend\PagesController@index']);
get('/hits', ['as' => 'public_hits', 'uses' => 'Frontend\PagesController@hits']);
get('/artist', ['as' => 'public_artists', 'uses' => 'Frontend\PagesController@artists']);
get('/artist/{name}', ['as' => 'public_artist', 'uses' => 'Frontend\PagesController@artist']);
get('/album/{name}/{album}', ['as' => 'public_album', 'uses' => 'Frontend\PagesController@album']);
get('/song/{name}/{album}/{song}', ['as' => 'public_song', 'uses' => 'Frontend\PagesController@song']);
get('/video', ['as' => 'public_video', 'uses' => 'Frontend\PagesController@video']);
get('/about', ['as' => 'public_about', 'uses' => 'Frontend\PagesController@about']);
get('/login', ['as' => 'public_sign_in', 'uses' => 'Frontend\PagesController@login']);
get('/register', ['as' => 'public_sign_up', 'uses' => 'Frontend\PagesController@register']);
get('/post', ['as' => 'public_post', 'uses' => 'Frontend\PostController@show']);

post('/auth',['as' => 'post_auth', 'uses' => 'Auth.AuthController@auth']);
post('/register_user', ['as' => 'post_register', 'uses' => 'Auth.AuthController@register']);

post('/feedback/send_feedback', ['as' => 'send_feedback', 'uses' => 'Frontend\PagesController@auth']);