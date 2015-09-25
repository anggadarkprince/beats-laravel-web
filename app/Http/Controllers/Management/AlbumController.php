<?php

namespace App\Http\Controllers\Management;

use App\Album;
use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAlbumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    private $album;

    /**
     * @param Album $album
     * @internal param Post $post
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Album $album
     * @return Response
     */
    public function index(Album $album)
    {
        $page = 'Album';

        $albums = $album->select("*","artists.slug as slugArtist","albums.slug as slugAlbum", 'albums.created_at as created_at')
            ->join('artists', 'albums.artist', '=', 'artists.id')
            ->orderBy('albums.released', 'desc')
            ->paginate(10);

        return view('albums.index', compact('page', 'albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $artist = new Artist();

        $artists = $artist->lists('name', 'id');

        return view('albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAlbumRequest|Request $request
     * @return Response
     */
    public function store(CreateAlbumRequest $request)
    {
        if ($request->hasFile('cover_file')) {
            $upload = $request->file('cover_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/img/cover/'), $fileName);
                $request->merge(['cover' => $fileName]);
            }
        }

        $this->album->create($request->all());

        Session::flash('status', Lang::get('alert.album_created'));

        return redirect()->route('admin::albums.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Response
     */
    public function edit($slug)
    {
        $artist = new Artist();

        $artists = $artist->lists('name', 'id');

        $album = $this->album->where('slug', $slug)->firstOrFail();

        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $album = $this->album->where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'description' => 'required|max:250',
            'label' => 'required|max:50',
            'released' => 'required|date',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,'.$album->id
        ]);

        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->hasFile('cover_file')) {
            $upload = $request->file('cover_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/img/cover/'), $fileName);
                $request->merge(['cover' => $fileName]);
            }
        }

        $album->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.album_updated'));

        return redirect()->route('admin::albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function destroy($slug)
    {
        $album = $this->album->where('slug', $slug)->firstOrFail();

        $album->delete();

        Session::flash('status', Lang::get('alert.album_deleted'));

        return redirect()->route('admin::albums.index');
    }
}
