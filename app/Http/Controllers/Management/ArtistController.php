<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArtistRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
    /**
     * artist object instance of App\Artist
     *
     * @var Artist
     */
    private $artist;

    /**
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = 'Artist';

        // retrieve all artists each 10 records data
        $artists = $this->artist->allArtists();

        return view('artists.index', compact('page', 'artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArtistRequest|Request $request
     * @return Response
     */
    public function store(CreateArtistRequest $request)
    {
        // upload avatar by request
        // return false if upload operation was fail
        $this->_uploadAvatar($request);

        $this->artist->create($request->all());

        return redirect()
            ->route('admin::artists.index')
            ->with('status', Lang::get('alert.artist_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function edit($slug)
    {
        // retrieve single data of artist by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $artist = $this->artist->where('slug', $slug)->firstOrFail();

        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param $slug
     * @return Response
     * @internal param int $id
     */
    public function update(Request $request, $slug)
    {
        // retrieve single data of artist by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $artist = $this->artist->where('slug', $slug)->firstOrFail();

        // rules for validation
        // avatar doesn't required to be updated and slug must be unique when changes
        $rules = [
            'name' => 'required',
            'about' => 'required|max:255',
            'birthday' => 'required',
            'birthplace' => 'required|max:100',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,' . $artist->id
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
        $this->_uploadAvatar($request);

        // save modified artist by related data which retrieved
        $artist->fill($request->all())->save();

        return redirect()
            ->route('admin::artists.index')
            ->with('status', Lang::get('alert.artist_updated'));
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
        // retrieve single data of album by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $post = $this->artist->where('slug', $slug)->firstOrFail();

        // delete artist by related data which retrieved
        $post->delete();

        return redirect()
            ->route('admin::artists.index')
            ->with('status', Lang::get('alert.artist_deleted'));
    }

    /**
     * upload album cover by passing a request
     *
     * @param CreateArtistRequest|Request $request
     */
    private function _uploadAvatar(Request $request)
    {
        // modified uploaded filename by slug because slug also unique
        $fileName = $request->input('slug');

        // passing all attributed to upload helper
        $upload = upload_file($request, 'avatar_file', base_path('public/img/avatar/'), $fileName);

        if ($upload['status']) {
            $request->merge(['avatar' => $upload['filename']]);
        }

        return $upload['status'];
    }
}
