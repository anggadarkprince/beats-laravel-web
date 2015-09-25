<?php

namespace App\Http\Controllers\Management;

use App\Feedback;
use App\Http\Requests\CreateFeedbackRequest;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class FeedbackController extends Controller
{
    private $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     * @internal param Feedback $feedback
     */
    public function index()
    {
        $page = 'Feedback';

        $feedback = $this->feedback->paginate(10);

        return view('feedback.index', compact('page', 'feedback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateFeedbackRequest|Request $request
     * @param Feedback $feedback
     * @return Response
     */
    public function store(CreateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->create($request->all());

        $request->session()->flash('status', Lang::get('alert.feedback_sent'));

        return redirect()->route('public_about');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $feedback = $this->feedback->find($id);

        $feedback->delete();

        Session::flash('status', Lang::get('alert.feedback_deleted'));

        return redirect()->route('admin::feedback.index');
    }
}
