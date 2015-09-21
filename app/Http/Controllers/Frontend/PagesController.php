<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $featured = ['New Artist', 'Soundtracks', 'Masterpiece', 'Top Chart', 'Meet & Greet', 'Concert'];
        $page = "Home page";
        return view('pages.home', compact('featured', 'page'));
    }

    public function hits()
    {
        return view('pages.hits');
    }

    public function artists()
    {
        return view('pages.artists');
    }

    public function artist($name)
    {
        return view('pages.artist');
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
