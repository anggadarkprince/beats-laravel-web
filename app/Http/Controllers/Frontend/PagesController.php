<?php

namespace App\Http\Controllers\Frontend;

use App\Album;
use App\Artist;
use App\Song;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    private $artist;
    private $album;
    private $song;

    /**
     * show homepage
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

    /**
     * show hits page
     * get all hits songs limit 10 data
     *
     * @return \Illuminate\View\View
     */
    public function hits()
    {
        $page = "Song Hits";

        $song = new Song();

        $hits = $song->getHitsSong();

        return view('pages.hits', compact('hits', 'page'));
    }

    /**
     * show artists page
     * get all artists with pagination 10 data each
     *
     * @return \Illuminate\View\View
     */
    public function artists()
    {
        $page = "Artists and Singers";

        $artist = new Artist();

        $artists = $artist->getArtistWithAlbum();

        return view('pages.artists', compact('artists', 'page'));
    }

    /**
     * select an artist
     * show artist profile, albums, videos, and articles
     *
     * @param $artistSlug
     * @return \Illuminate\View\View
     */
    public function artist($artistSlug)
    {
        $artistData = $this->_artistsBySlug($artistSlug);

        $albums = $artistData->albums()->get();

        $videos = $artistData->videos()->get();

        $posts = $artistData->posts()->get();

        return view('pages.artist', compact('artistData', 'albums', 'videos', 'posts', 'page'));
    }

    /**
     * select an album by related artist
     * show all song related by selected album
     *
     * @param $artistSlug
     * @param $albumSlug
     * @return \Illuminate\View\View
     */
    public function album($artistSlug, $albumSlug)
    {
        $artistData = $this->_artistsBySlug($artistSlug);

        $albumData = $this->_albumBySlug($albumSlug);

        $songs = $albumData->songs()->get();

        return view('pages.album', compact('artistData', 'albumData', 'songs'));
    }

    /**
     * select a song by related album
     * show lyric and info related by selected song
     *
     * @param $artistSlug
     * @param $albumSlug
     * @param $songSlug
     * @return \Illuminate\View\View
     */
    public function song($artistSlug, $albumSlug, $songSlug)
    {
        $artistData = $this->_artistsBySlug($artistSlug);

        $albumData = $this->_albumBySlug($albumSlug);

        $songData = $this->_songBySlug($songSlug);

        return view('pages.song', compact('artistData', 'albumData', 'songData'));
    }

    /**
     * show video page
     *
     * @return \Illuminate\View\View
     */
    public function video()
    {
        $page = "Music Video";

        return view('pages.video', compact('page'));
    }

    /**
     * show about page
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        $page = "Contact Us";

        return view('pages.about', compact('page'));
    }

    /**
     * retrieve artist data by slug
     *
     * @param $artistSlug
     * @return mixed
     */
    private function _artistsBySlug($artistSlug)
    {
        $this->artist = new Artist();

        $artistData = $this->artist->whereSlug($artistSlug)->firstOrFail();

        return $artistData;
    }

    /**
     * retrieve album data by slug
     *
     * @param $albumSlug
     * @return mixed
     */
    private function _albumBySlug($albumSlug)
    {
        $this->album = new Album();

        $albumData = $this->album->where("slug", $albumSlug)->firstOrFail();

        return $albumData;
    }

    /**
     * retrieve song by slug
     *
     * @param $songSlug
     * @return mixed
     */
    private function _songBySlug($songSlug)
    {
        $this->song = new Song();

        $songData = $this->song->whereSlug($songSlug)->firstOrFail();

        return $songData;
    }

}
