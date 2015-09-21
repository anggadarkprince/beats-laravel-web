<?php

namespace App\Http\Controllers\Management;

use App\Http\Requests\CreateSongRequest;
use App\Song;
use Illuminate\Http\Request;

/**
 * Class SongsController
 * @package App\Http\Controllers
 */
class SongsController extends Controller
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

}
