<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function setting()
    {
        $userData = Auth::user();

        return view('users.setting', compact('userData'));
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return Response
     */
    public function show($slug)
    {
        $user = new User();

        $name = str_replace('-',' ', $slug);

        $userData = $user->where('name', 'like', '%'.$name.'%')->firstOrFail();

        $playlistData = $userData->playlist()->get();

        return view('pages.user', compact('userData', 'playlistData'));
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
     * @param  Request $request
     * @param User $user
     * @return Response
     * @internal param User $playlist
     * @internal param int $id
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'gender' => 'required',
            'password_old' => 'required|check_password',
            'password_new' => 'confirmed|min:6'
        ], ['check_password' => 'The old password mismatch with current password']);

        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->hasFile('avatar_file')) {
            $upload = $request->file('avatar_file');
            if ($upload->isValid())
            {
                $fileName = Auth::user()->id.'.'.$upload->getClientOriginalExtension();
                $upload->move(base_path('public/img/avatar/'), $fileName);
                $request->merge(['avatar' => $fileName]);
            }
        }

        if($request->has('password_new')){
            $request->merge(['password' => Hash::make($request->password_new)]);
        }

        $user->fill($request->all())->save();

        $request->session()->flash('status', 'success');

        $request->session()->flash('message', Lang::get('alert.setting_updated'));

        return redirect()->route('private_setting');
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
