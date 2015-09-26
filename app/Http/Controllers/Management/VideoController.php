<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Requests\CreateVideoRequest;
use App\Video;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    private $video;

    /**
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'Video';

        $videos = $this->video
            ->select('*', 'videos.slug as videoSlug', 'artists.slug as artistSlug', 'videos.created_at as uploaded_at')
            ->join('artists', 'videos.artist', '=', 'artists.id')
            ->orderBy('videos.created_at', 'desc')
            ->paginate(10);

        return view('videos.index', compact('page', 'videos'));
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

        return view('videos.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVideoRequest|Request $request
     * @return Response
     */
    public function store(CreateVideoRequest $request)
    {
        if ($request->hasFile('poster_file')) {
            $upload = $request->file('poster_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/vid/'), $fileName);
                $request->merge(['poster' => $fileName]);
            }
        }

        if ($request->hasFile('resource_file')) {
            $upload = $request->file('resource_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/vid/'), $fileName);
                $request->merge(['resource' => $fileName]);
            }
        }

        $this->video->create($request->all());

        Session::flash('status', Lang::get('alert.video_created'));

        return redirect()->route('admin::videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        $video = new Video();

        $videoData = $video->where('slug', $slug)->firstOrFail();

        return view('pages.player', compact('videoData'));
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

        $video = $this->video->where('slug', $slug)->firstOrFail();

        return view('videos.edit', compact('video', 'artists'));
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
        $video = $this->video->where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'artist' => 'required',
            'title' => 'required|max:50',
            'description' => 'required|max:250',
            'poster_file' => 'image',
            'resource_file' => 'mimes:mp4|max:2000',
            'slug' => 'required|alpha_dash|max:255|unique:videos,slug,'.$video->id
        ]);

        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->hasFile('poster_file')) {
            $upload = $request->file('poster_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/vid/'), $fileName);
                $request->merge(['poster' => $fileName]);
            }
        }

        if ($request->hasFile('resource_file')) {
            $upload = $request->file('resource_file');
            if ($upload->isValid())
            {
                $fileName = $request->input('slug').'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/vid/'), $fileName);
                $request->merge(['resource' => $fileName]);
            }
        }

        $video->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.video_updated'));

        return redirect()->route('admin::videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     */
    public function destroy($slug)
    {
        $video = $this->video->where('slug', $slug)->firstOrFail();

        $video->delete();

        Session::flash('status', Lang::get('alert.video_deleted'));

        return redirect()->route('admin::videos.index');
    }
}
