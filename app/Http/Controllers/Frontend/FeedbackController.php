<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 9/19/2015
 * Time: 9:17 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFeedbackRequest;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{
    private $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function index()
    {
        $feedbackData = $this->feedback->get();

        return view('pages.about', compact('feedbackData'));
    }

    public function show($id)
    {
        $feedback = $this->feedback->where('id', $id)->first();

        return view('pages.about', compact('feedback'));
    }

    public function store(CreateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->create($request->all());

        $request->session()->flash('status', Lang::get('alert.feedback_sent'));

        return redirect()->route('public_about');
    }

}