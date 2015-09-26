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
    /**
     * album object instance of App\Album
     *
     * @var Album
     */
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
     * @return Response
     * @internal param Album $album
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = 'Album';

        // retrieve all albums each 10 records data
        // each album related by artist
        $albums = $this->album->allAlbums();

        return view('albums.index', compact('page', 'albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Artist $artist
     * @return Response
     */
    public function create(Artist $artist)
    {
        // create assoc array key id (artist) => name (artist)
        // list for artist drop down
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
        // upload cover by request
        // return false if upload operation was fail
        $this->_uploadCover($request);

        $this->album->create($request->all());

        Session::flash('status', Lang::get('alert.album_created'));

        return redirect()->route('admin::albums.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @param Artist $artist
     * @return Response
     */
    public function edit($slug, Artist $artist)
    {
        // create assoc array key id (artist) => name (artist)
        // list for artist drop down
        $artists = $artist->lists('name', 'id');

        // retrieve single data of album by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
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
        // retrieve single data of album by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $album = $this->album->where('slug', $slug)->firstOrFail();

        // rules for validation
        // cover doesn't required to be updated and slug must be unique when changes
        $rules = [
            'title' => 'required|max:50',
            'description' => 'required|max:250',
            'label' => 'required|max:50',
            'released' => 'required|date',
            'slug' => 'required|alpha_dash|max:255|unique:albums,slug,' . $album->id
        ];
        $validator = Validator::make($request->all(), $rules);

        // check validation process pass or fail
        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        // upload cover by request
        // return false if upload operation was fail
        $this->_uploadCover($request);

        // save modified album by related data which retrieved
        $album->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.album_updated'));

        return redirect()->route('admin::albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     */
    public function destroy($slug)
    {
        // retrieve single data of album by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $album = $this->album->where('slug', $slug)->firstOrFail();

        // delete album by related data which retrieved
        $album->delete();

        Session::flash('status', Lang::get('alert.album_deleted'));

        return redirect()->route('admin::albums.index');
    }

    /**
     * upload album cover by passing a request
     *
     * @param CreateAlbumRequest|Request $request
     */
    private function _uploadCover(Request $request)
    {
        // modified uploaded filename by slug because slug also unique
        $fileName = $request->input('slug');

        // passing all attributed to upload helper
        $upload = upload_file($request, 'cover_file', base_path('public/img/cover/'), $fileName);

        if ($upload['status']) {
            $request->merge(['cover' => $upload['filename']]);
        }

        return $upload['status'];
    }
}
