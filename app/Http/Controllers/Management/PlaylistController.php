<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePlaylistRequest;
use App\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class PlaylistController extends Controller
{
    /**
     * playlist object instance of App\Playlist
     *
     * @var Playlist
     */
    private $playlist;

    public function __construct(Playlist $playlist)
    {
        // this controller need to be member and authorization
        // this authorization just for 'user' level
        $this->middleware('auth');

        $this->playlist = $playlist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // retrieve logged in user via Auth facade
        $userData = Auth::user();

        // get playlist related by logged user
        // user-playlist has one-to-many relationship where one user has many playlist
        $playlistData = $userData->playlist()->get();

        return view('playlist.index', compact('userData', 'playlistData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // retrieve logged in user via Auth facade
        $userData = Auth::user();

        return view('playlist.create', compact('userData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePlaylistRequest|Request $request
     * @return Response
     */
    public function store(CreatePlaylistRequest $request)
    {
        // modifying request input data for related record
        // user is a subject who has the playlist as foreign key
        $request->merge(['creator' => Auth::user()->id]);

        $this->playlist->create($request->all());

        $playlistName = $request->input('list');

        return redirect()
            ->route('playlist')
            ->with('status', '<strong>' . $playlistName . '</strong> ' . Lang::get('alert.playlist_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Playlist $playlist
     * @return Response
     */
    public function show(Playlist $playlist)
    {
        $userData = Auth::user();

        $songs = $playlist->songs()->get();

        return view('playlist.show', compact('userData', 'playlist', 'songs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Playlist $playlist
     * @return Response
     */
    public function edit(Playlist $playlist)
    {
        // retrieve logged in user via Auth facade
        $userData = Auth::user();

        // playlist data was injected by route return single of playlist by id
        return view('playlist.edit', compact('userData', 'playlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePlaylistRequest|Request $request
     * @param Playlist $playlist
     * @return Response
     */
    public function update(CreatePlaylistRequest $request, Playlist $playlist)
    {
        // playlist data was injected by route return single of playlist by id
        $playlist->fill($request->all())->save();

        // retrieve playlist label for information
        $playlistName = $request->input('list');

        return redirect()
            ->route('playlist')
            ->with('status', '<strong>' . $playlistName . '</strong> ' . Lang::get('alert.playlist_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Playlist $playlist
     * @return Response
     */
    public function destroy(Playlist $playlist)
    {
        // playlist data was injected by route return single of playlist by id
        // retrieve playlist label for information
        $playlistName = $playlist->list;

        // delete playlist by related data which retrieved
        $playlist->delete();

        return redirect()
            ->route('playlist')
            ->with('status', '<strong>' . $playlistName . '</strong> ' . Lang::get('alert.playlist_deleted'));
    }
}
