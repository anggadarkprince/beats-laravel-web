<?php

namespace App\Http\Controllers\Frontend;

use App\Artist;
use App\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = "Home page";

        $featured = ['New Artist', 'Soundtracks', 'Masterpiece', 'Top Chart', 'Meet & Greet', 'Concert'];

        return view('pages.home', compact('featured', 'page'));
    }

    public function hits()
    {
        $page = "Song Hits";

        $song = new Song();

        $hits = $song->getHitsSong();

        return view('pages.hits', compact('hits', 'page'));
    }

    public function artists()
    {
        $page = "Artists and Singers";

        $artist = new Artist();

        $artists = $artist->getArtistWithAlbum();

        return view('pages.artists', compact('artists', 'page'));
    }

    public function artist($artistSlug)
    {
        $page = "Artist";

        $artist = new Artist();

        $artistData = $artist->whereSlug($artistSlug)->firstOrFail();

        $albums = $artistData->albums()->get();

        $videos = $artistData->videos()->get();

        $posts = $artistData->posts()->get();

        return view('pages.artist', compact('artistData', 'albums', 'videos', 'posts', 'page'));
    }

    public function album($name, $album)
    {
        return view('pages.album');
    }

    public function song($name, $album, $song)
    {
        return view('pages.song');
    }

    public function video()
    {
        return view('pages.video');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }

}
