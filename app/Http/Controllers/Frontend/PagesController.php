<?php

namespace App\Http\Controllers\Frontend;

use App\Album;
use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Song;
use App\User;
use App\Video;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * artist object instance of App\Artist
     *
     * @var Artist
     */
    private $artist;

    /**
     * album object instance of App\Album
     *
     * @var Album
     */
    private $album;

    /**
     * album song instance of App\Song
     *
     * @var Song
     */
    private $song;

    /**
     * show homepage
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = "Home page";

        // caption feature, just for testing variable he..he..he.. :)
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
        // title page for meta data in web browser
        $page = "Song Hits";

        // lazy instantiate song when we need only
        $this->song = new Song();

        // get the greatest hit song by status 'is_hit', manage by administrator :)
        $hits = $this->song->getHitsSong();

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
        // title page for meta data in web browser
        $page = "Artists and Singers";

        // lazy instantiate song when we need only
        $this->artist = new Artist();

        // get all artist each 10 records with total albums information
        $artists = $this->artist->getArtistWithAlbum();

        return view('pages.artists', compact('artists', 'page'));
    }

    /**
     * select an artist
     * show artist profile, albums, videos, and articles
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function artist($slug)
    {
        $artistData = $this->_artistsBySlug($slug);

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

        if(Auth::check()){
            $user = new User();

            $userData = $user->find(Auth::user()->id);

            $playlistData = $userData->playlist()->get();

            $savedPlaylist = $this->_isSongSaved($songData->id, Auth::user()->id);
        }

        return view('pages.song', compact('artistData', 'albumData', 'songData', 'playlistData', 'savedPlaylist'));
    }

    /**
     * show video page
     *
     * @return \Illuminate\View\View
     */
    public function video()
    {
        $page = "Music Video";

        $video = new Video();

        $videoData = $video->allVideos();

        return view('pages.video', compact('page', 'videoData'));
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

        // retrieve single data of artist by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
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

        // retrieve single data of album by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
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

        // retrieve single data of song by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $songData = $this->song->whereSlug($songSlug)->firstOrFail();

        return $songData;
    }

    /**
     * @param $songId
     * @param $userId
     * @return null
     */
    private function _isSongSaved($songId, $userId)
    {
        $user = new User();

        // get current user data
        $userData = $user->find($userId);

        // find all him/her related playlist
        $userPlaylist = $userData->playlist()->get();

        // loop through all of collection to check and retrieve songs each playlist
        foreach($userPlaylist as $playlist){
            // find single data of playlist by id
            $playlistData = $playlist->find($playlist->id);

            // retrieve all songs in current playlist by id at playlist data
            $songs = $playlistData->songs()->get();

            // now loop through song collection by playlist has given
            foreach($songs as $song){
                // check what if a song at current page which look by current user
                // exist in current collection of song in current playlist
                // if matched and found, return and tell next method to process this playlist
                // because this song will be removed from the playlist
                if($song->id == $songId){
                    return $playlist;
                }
            }
        }

        // all loops pass and this code will be executed, that
        // means nothing playlist saved the song related by user collection
        return null;
    }

}
