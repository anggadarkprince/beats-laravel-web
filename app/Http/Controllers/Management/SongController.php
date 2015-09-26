<?php

namespace App\Http\Controllers\Management;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSongRequest;
use App\PlaylistSong;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Class SongsController
 * @package App\Http\Controllers
 */
class SongController extends Controller
{
    /**
     * song object instance of App\Song
     *
     * @var Post
     */
    private $song;

    /**
     * @param Song $song
     */
    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = 'Song';

        // retrieve all songs each 10 records data
        // each song related by album
        $songs = $this->song->allSongs();

        return view('songs.index', compact('page', 'songs'));
    }

    /**
     * @param Album $album
     * @return \Illuminate\View\View
     */
    public function create(Album $album)
    {
        // create assoc array key id (album) => title (album)
        // list for artist drop down
        $albums = $album->lists('title', 'id');

        return view('songs.create', compact('albums'));
    }

    /**
     * @param CreateSongRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSongRequest $request)
    {
        $this->song->create($request->all());

        return redirect()
            ->route('admin::songs.index')
            ->with('status', Lang::get('alert.song_created'));
    }

    /**
     * @param $slug
     * @param Album $album
     * @return \Illuminate\View\View
     */
    public function edit($slug, Album $album)
    {
        // create assoc array key id (album) => title (album)
        // list for artist drop down
        $albums = $album->lists('title', 'id');

        // retrieve single data of song by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $song = $this->song->where('slug', $slug)->firstOrFail();

        return view('songs.edit', compact('song', 'albums'));
    }

    /**
     * @param CreateSongRequest|Request $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        // retrieve single data of song by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $song = $this->song->whereSlug($slug)->firstOrFail();

        // rules for validation
        // slug must be unique when changes
        $rules = [
            'title' => 'required|max:50',
            'lyrics' => 'required',
            'writer' => 'required|max:100',
            'music' => 'required|max:100',
            'duration' => 'required|date_format:m:s',
            'slug' => 'required|alpha_dash|max:255|unique:songs,slug,' . $song->id
        ];
        $validator = Validator::make($request->all(), $rules);

        // check validation process pass or fail
        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        // save modified song by related data which retrieved
        $song->fill($request->all())->save();

        return redirect()
            ->route('admin::songs.index')
            ->with('status', Lang::get('alert.song_updated'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        // retrieve single data of song by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $song = $this->song->where('slug', $slug)->firstOrFail();

        // delete album by related data which retrieved
        $song->delete();

        return redirect()
            ->route('admin::songs.index')
            ->with('status', Lang::get('alert.song_deleted'));
    }

    /**
     * save a song to playlist, this request comes via AJAX
     *
     * @param Request $request
     * @param PlaylistSong $playlistSong
     * @return string|static
     */
    public function saveToPlaylist(Request $request, PlaylistSong $playlistSong)
    {
        // user must be logged in and authorized
        if (Auth::check()) {

            // retrieve single data of song by slug
            // if a unregistered slug has been given by client then fail and return page not found 404
            // get song id which saved to playlist
            $song = $this->song->whereSlug($request->input('song'))->firstOrFail()->id;

            // modifying request input data for related record
            // song is a subject which saved to playlist as foreign key
            $request->merge(['song' => $song]);

            return $playlistSong->create($request->all());
        }
        return 'false';
    }

    /**
     * delete or remove song from playlist at the song page
     *
     * @param Request $request
     * @param PlaylistSong $playlistSong
     * @return string
     */
    public function deleteFromPlaylist(Request $request, PlaylistSong $playlistSong)
    {
        // user must be logged in and authorized
        if (Auth::check()) {

            // retrieve single data of song by slug
            // if a unregistered slug has been given by client then fail and return page not found 404
            // get song id which saved in playlist before
            $song = $this->song->whereSlug($request->input('song'))->firstOrFail()->id;

            // modifying request input data for related record
            // song is a subject which removed from playlist as foreign key
            $request->merge(['song' => $song]);

            // retrieve and remove record by composite key : song and playlist
            $list = $playlistSong
                ->where('song', $request->input('song'))
                ->where('playlist', $request->input('playlist'))
                ->firstOrFail();

            $list->delete();

            return 'true';
        }
        return 'false';
    }

}
