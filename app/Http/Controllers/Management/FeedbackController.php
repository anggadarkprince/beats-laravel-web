<?php

namespace App\Http\Controllers\Management;

use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFeedbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{
    /**
     * feedback object instance of App\Feedback
     *
     * @var Comment
     */
    private $feedback;

    /**
     * @param Feedback $feedback
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // title page for meta data in web browser
        $page = 'Feedback';

        // retrieve all artist each 10 record data
        $feedback = $this->feedback->paginate(10);

        return view('feedback.index', compact('page', 'feedback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFeedbackRequest|Request $request
     * @return Response
     */
    public function store(CreateFeedbackRequest $request)
    {
        $this->feedback->create($request->all());

        return redirect()->route('public_about')
            ->with('status', Lang::get('alert.feedback_sent'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $feedback = $this->feedback->find($id);

        return view('feedback.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        // retrieve single data of feedback by slug, prepare for Eloquent model
        // if a unregistered slug has been given by client then fail and return page not found 404
        $feedback = $this->feedback->find($id);

        // delete feedback by related data which retrieved
        $feedback->delete();

        return redirect()->route('admin::feedback.index')
            ->with('status', Lang::get('alert.feedback_deleted'));
    }
}
