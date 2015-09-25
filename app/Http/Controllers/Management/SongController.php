<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSongRequest;
use App\PlaylistSong;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class SongsController
 * @package App\Http\Controllers
 */
class SongController extends Controller
{
    private $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    public function index()
    {
        $songs = $this->song->get();

        return view('songs.index', compact('songs'));
    }

    public function show($slug)
    {
        $song = $this->song->whereSlug($slug)->first();

        return view('songs.show', compact('song'));
    }

    public function create()
    {
        return view('songs.create');
    }

    public function store(CreateSongRequest $request, Song $song)
    {
        $song->create($request->all());

        return redirect()->route('songs_path');
    }

    public function edit($slug)
    {
        $song = $this->song->whereSlug($slug)->first();

        return view('songs.edit', compact('song'));
    }

    public function update($slug, CreateSongRequest $request)
    {
        $song = $this->song->whereSlug($slug)->first();

        $song->fill($request->all())->save();

        // $request->input()
        //$song->fill(['title' => $request->get('title')])->save();
        //$song->title = $request->get('title');

        //$song->save();

        return redirect('music');
    }

    public function destroy($slug)
    {
        $song = $this->song->whereSlug($slug)->first();

        $song->delete();

        return redirect('music');
    }

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
