<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVideoRequest;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * video object instance of App\Video
     *
     * @var Artist
     */
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
        // title page for meta data in web browser
        $page = 'Video';

        // retrieve all videos each 10 records data
        $videos = $this->video->allVideos();

        return view('videos.index', compact('page', 'videos'));
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
        // upload poster by request
        // return false if upload operation was fail
        $this->_uploadData($request, 'poster_file', 'poster');

        // upload video by request
        // return false if upload operation was fail
        $this->_uploadData($request, 'resource_file', 'resource');

        $this->video->create($request->all());

        return redirect()
            ->route('admin::videos.index')
            ->with('status', Lang::get('alert.video_created'));
    }

    /**
     * @param CreateVideoRequest|Request $request
     * @param $source
     * @param $field
     * @return array
     */
    private function _uploadData(Request $request, $source, $field)
    {
        // modified uploaded filename by slug because slug also unique
        $fileName = $request->input('slug');

        // passing all attributed to upload helper
        $upload = upload_file($request, $source, base_path('public/vid/'), $fileName);

        if ($upload['status']) {
            $request->merge([$field => $upload['filename']]);
        }

        return $upload['status'];
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Response
     */
    public function show($slug)
    {
        // retrieve single data of video by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $videoData = $this->video->where('slug', $slug)->firstOrFail();

        return view('pages.player', compact('videoData'));
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

        // rules for validation
        // slug must be unique when changes
        $rules = [
            'artist' => 'required',
            'title' => 'required|max:50',
            'description' => 'required|max:250',
            'poster_file' => 'image',
            'resource_file' => 'mimes:mp4,mpg|max:2000',
            'slug' => 'required|alpha_dash|max:255|unique:videos,slug,' . $video->id
        ];
        $validator = Validator::make($request->all(), $rules);

        // check validation process pass or fail
        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        // upload poster by request
        // return false if upload operation was fail
        $this->_uploadData($request, 'poster_file', 'poster');

        // upload video by request
        // return false if upload operation was fail
        $this->_uploadData($request, 'resource_file', 'resource');

        // save modified album by related data which retrieved
        $video->fill($request->all())->save();

        return redirect()
            ->route('admin::videos.index')
            ->with('status', Lang::get('alert.video_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     */
    public function destroy($slug)
    {
        // retrieve single data of video by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $video = $this->video->where('slug', $slug)->firstOrFail();

        // delete album by related data which retrieved
        $video->delete();

        return redirect()
            ->route('admin::videos.index')
            ->with('status', Lang::get('alert.video_deleted'));
    }
}
