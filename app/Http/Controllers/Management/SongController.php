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
        $page = 'Album';

        $songs = $this->song
            ->select('*','artists.name as artist', 'albums.title as album', 'artists.slug as slugArtist', 'albums.slug as slugAlbum', 'songs.slug as slugSong', 'songs.created_at as created_at')
            ->join('albums', 'songs.album', '=', 'albums.id')
            ->join('artists', 'albums.artist', '=', 'artists.id')
            ->orderBy('songs.created_at', 'desc')
            ->paginate(10);

        return view('songs.index', compact('page', 'songs'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $album = new Album();

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

        Session::flash('status', Lang::get('alert.song_created'));

        return redirect()->route('admin::songs.index');
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $album = new Album();

        $albums = $album->lists('title', 'id');

        $song = $this->song->where('slug', $slug)->first();

        return view('songs.edit', compact('song', 'albums'));
    }

    /**
     * @param CreateSongRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $slug)
    {
        $song = $this->song->whereSlug($slug)->first();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'lyrics' => 'required',
            'writer' => 'required|max:100',
            'music' => 'required|max:100',
            'duration' => 'required|date_format:h:m:s',
            'slug' => 'required|alpha_dash|max:255|unique:songs,slug,'.$song->id
        ]);

        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        $song->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.song_updated'));

        return redirect()->route('admin::songs.index');
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $song = $this->song->where('slug', $slug)->firstOrFail();

        $song->delete();

        Session::flash('status', Lang::get('alert.song_deleted'));

        return redirect()->route('admin::songs.index');
    }

    /**
     * @param Request $request
     * @return string|static
     */
    public function saveToPlaylist(Request $request)
    {
        $playlistSong = new PlaylistSong();
        if(Auth::check()){
            $song = $this->song->whereSlug($request->input('song'))->firstOrFail()->id;
            $request->merge(['song' => $song]);
            return $playlistSong->create($request->all());
        }
        return 'false';
    }

    /**
     * @param Request $request
     * @return string
     */
    public function deleteFromPlaylist(Request $request)
    {
        $playlistSong = new PlaylistSong();

        if(Auth::check()) {
            $song = $this->song->whereSlug($request->input('song'))->firstOrFail()->id;

            $request->merge(['song' => $song]);

            $list = $playlistSong->where('song', $request->input('song'))->where('playlist', $request->input('playlist'))->first();

            $list->delete();

            return 'true';
        }
        return 'false';
    }

}
