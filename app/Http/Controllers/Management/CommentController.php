<?php

namespace App\Http\Controllers\Management;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{
    /**
     * comment object instance of App\Comment
     *
     * @var Comment
     */
    private $comment;

    /**
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = 'Comments';

        // retrieve all artist each 10 record data
        $comments = $this->comment->allComments();

        return view('comments.index', compact('page', 'comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCommentRequest|Request $request
     * @param Post $post
     * @param $slug
     * @return Response
     * @internal param Comment $comment
     */
    public function store(CreateCommentRequest $request, Post $post, $slug)
    {
        // retrieve single data of post by slug
        // if a unregistered slug has been given by client then fail and return page not found 404
        $article = $post->where('slug', $slug)->firstOrFail();

        // modifying request input data for related record
        // user is a subject who sent the comment as foreign key
        // post is a article which commented by user as foreign key
        $request->merge(['user' => Auth::user()->id]);
        $request->merge(['post' => $article->id]);

        $this->comment->create($request->all());

        return redirect()
            ->route('public_post', [$slug])
            ->with('status', Lang::get('alert.comment_sent'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $comment = $this->comment->singleComment($id);

        return view('comments.show', compact('comment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        // retrieve single data of comment by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $comment = $this->comment->find($id);

        // delete comment by related data which retrieved
        $comment->delete();

        return redirect()
            ->route('admin::comments.index')
            ->with('status', Lang::get('alert.comment_deleted'));
    }
}
