<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CreatePostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'artist' => 'required',
            'title' => 'required|max:100',
            'content' => 'required',
            'slug' => 'required|alpha_dash|max:255|unique:posts,slug'
        ];
    }
}
