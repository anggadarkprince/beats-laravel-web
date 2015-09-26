<?php

namespace App\Http\Controllers\Management;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * post object instance of App\Post
     *
     * @var Post
     */
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
        // title page for meta data in web browser
        $page = 'Posts';

        // retrieve all posts each 10 records data
        // each post related by artist
        $posts = $this->post->allPosts();

        return view('posts.index', compact('page', 'posts'));
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
        // modifying request input data for related record
        // user is a author who create the post as foreign key
        $request->merge(['author' => Auth::user()->id]);

        $this->post->create($request->all());

        return redirect()
            ->route('admin::posts.index')
            ->with('status', Lang::get('alert.post_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $slug
     * @return Response
     */
    public function show($slug = null)
    {
        // retrieve single data of post by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $article = $this->post->whereSlug($slug)->firstOrFail();

        // retrieve user as author (belongsTo)
        $author = $article->author()->firstOrFail();

        // get comment related by this post (hasMany)
        // post-comment has one-to-many relationship where one post has many comment
        $comments = $article->comments()->get();

        return view('pages.post', compact('article', 'author', 'comments'));
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

        // retrieve single data of post by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $post = $this->post->where('slug', $slug)->firstOrFail();

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

        // rules for validation
        // slug must be unique when changes
        $rules = [
            'artist' => 'required',
            'title' => 'required|max:100',
            'content' => 'required',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug,' . $post->id
        ];
        $validator = Validator::make($request->all(), $rules);

        // check validation process pass or fail
        if ($validator->fails()) {
            Session::flash('status', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        // save modified post by related data which retrieved
        $post->fill($request->all())->save();

        return redirect()
            ->route('admin::posts.index')
            ->with('status', Lang::get('alert.post_updated'));
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
        $post = $this->post->where('slug', $slug)->firstOrFail();

        // delete album by related data which retrieved
        $post->delete();

        return redirect()
            ->route('admin::posts.index')
            ->with('status', Lang::get('alert.post_deleted'));
    }
}
