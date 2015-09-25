<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CreateSongRequest extends Request
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
            'title' => 'required|max:50',
            'lyrics' => 'required',
            'writer' => 'required|max:100',
            'music' => 'required|max:100',
            'duration' => 'required|date_format:h:m',
            'slug' => 'required|alpha_dash|max:255|unique:songs,slug'
        ];
    }
}
