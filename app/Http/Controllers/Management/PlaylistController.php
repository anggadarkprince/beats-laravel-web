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

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userData = Auth::user();

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
        $userData = Auth::user();

        return view('playlist.create', compact('userData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePlaylistRequest|Request $request
     * @param Playlist $playlist
     * @return Response
     */
    public function store(CreatePlaylistRequest $request, Playlist $playlist)
    {
        $request->merge(['creator' => Auth::user()->id]);

        $playlist->create($request->all());

        $playlistName = $request->input('list');

        $request->session()->flash('status', '<strong>'.$playlistName.'</strong> '.Lang::get('alert.playlist_created'));

        return redirect()->route('playlist');
    }

    /**
     * Display the specified resource.
     *
     * @param Playlist $playlist
     * @return Response
     * @internal param int $id
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
     * @internal param int $id
     */
    public function edit(Playlist $playlist)
    {
        $userData = Auth::user();

        return view('playlist.edit', compact('userData', 'playlist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePlaylistRequest|Request $request
     * @param Playlist $playlist
     * @return Response
     * @internal param int $id
     */
    public function update(CreatePlaylistRequest $request, Playlist $playlist)
    {
        $playlist->fill($request->all())->save();

        $playlistName = $request->input('list');

        $request->session()->flash('status', '<strong>'.$playlistName.'</strong> '.Lang::get('alert.playlist_deleted'));

        return redirect()->route('playlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CreatePlaylistRequest|Request $request
     * @param Playlist $playlist
     * @return Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Request $request, Playlist $playlist)
    {
        $playlistName = $playlist->list;

        $playlist->delete();

        $request->session()->flash('status', '<strong>'.$playlistName.'</strong> '.Lang::get('alert.playlist_deleted'));

        return redirect()->route('playlist');
    }
}
