<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CreateVideoRequest extends Request
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
            'title' => 'required|max:50',
            'description' => 'required|max:250',
            'resource_file' => 'required|mimes:mp4,mpg|max:2000',
            'poster_file' => 'required|image',
            'slug' => 'required|alpha_dash|max:255|unique:videos,slug'
        ];
    }
}
