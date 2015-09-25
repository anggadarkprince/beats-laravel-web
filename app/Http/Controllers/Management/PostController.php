<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $post;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'Posts';

        $posts = $this->post
            ->select('*', 'artists.name as artist', 'users.name as author', 'posts.slug as slug', 'artists.slug as artistSlug', 'artists.avatar as artistAvatar', 'users.avatar as authorAvatar', 'posts.created_at as created_at')
            ->join('artists', 'posts.artist', '=', 'artists.id')
            ->join('users', 'posts.author', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);

        return view('posts.index', compact('page', 'posts'));
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

        return view('posts.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest|Request $request
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $request->merge(['author' => Auth::user()->id]);

        $this->post->create($request->all());

        Session::flash('status', Lang::get('alert.post_created'));

        return redirect()->route('admin::posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function show($slug = null)
    {
        $post = new Post();

        $article = $post->whereSlug($slug)->firstOrFail();

        $author = $article->author()->firstOrFail();

        $comments = $article->comments()->get();

        return view('pages.post', compact('article', 'author', 'comments'));
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

        $post = $this->post->where('slug', $slug)->first();

        return view('posts.edit', compact('post', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePostRequest|Request $request
     * @param $slug
     * @return Response
     */
    public function update(Request $request, $slug)
    {
        $post = $this->post->where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'artist' => 'required',
            'title' => 'required|max:100',
            'content' => 'required',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,'.$post->id
        ]);

        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        $post->fill($request->all())->save();

        Session::flash('status', Lang::get('alert.post_updated'));

        return redirect()->route('admin::posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return Response
     */
    public function destroy($slug)
    {
        $post = $this->post->where('slug', $slug)->firstOrFail();

        $post->delete();

        Session::flash('status', Lang::get('alert.post_deleted'));

        return redirect()->route('admin::posts.index');
    }
}
