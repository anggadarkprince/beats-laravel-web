<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class CreateArtistRequest extends Request
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
            'name' => 'required',
            'about' => 'required|max:255',
            'birthday' => 'required',
            'birthplace' => 'required|max:100',
            'avatar_file' => 'required',
            'slug' => 'required|alpha_dash|max:255|unique:artists,slug'
        ];
    }
}
