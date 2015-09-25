<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Requests\CreateArtistRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArtistController extends Controller
{
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
     * @return Response
     * @internal param Artist $artist
     */
    public function index()
    {
        $page = 'Artist';

        $artists = $this->artist
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
        if ($request->hasFile('avatar_file')) {
            $upload = $request->file('avatar_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/img/avatar/'), $fileName);
                $request->merge(['avatar' => $fileName]);
            }
        }

        $this->artist->create($request->all());

        Session::flash('status', Lang::get('alert.artist_created'));

        return redirect()->route('admin::artists.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        $post = $this->artist->where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'about' => 'required|max:255',
            'birthday' => 'required',
            'birthplace' => 'required|max:100',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,'.$post->id
        ]);

        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->hasFile('avatar_file')) {
            $upload = $request->file('avatar_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/img/avatar/'), $fileName);
                $request->merge(['avatar' => $fileName]);
            }
        }

        $post->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.artist_updated'));

        return redirect()->route('admin::artists.index');
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
        $post = $this->artist->where('slug', $slug)->firstOrFail();

        $post->delete();

        Session::flash('status', Lang::get('alert.post_deleted'));

        return redirect()->route('admin::artists.index');
    }
}
