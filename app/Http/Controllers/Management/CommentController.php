<?php

namespace App\Http\Controllers\Management;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->middleware('auth', ['only' => 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @param Post $post
     * @param $slug
     * @return Response
     * @internal param Comment $comment
     */
    public function store(Request $request, Post $post, $slug)
    {
        $article = $post->where('slug', $slug)->firstOrFail();

        $request->merge(['user' => Auth::user()->id]);
        $request->merge(['post' => $article->id]);

        $this->comment->create($request->all());

        $request->session()->flash('status', Lang::get('alert.comment_sent'));

        return redirect()->route('public_post', [$slug]);
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
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
