<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->middleware('auth', ['except' => 'show']);

        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page = 'Album';

        $users = $this->user
            ->where('level', 'USER')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.index', compact('page', 'users'));
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
     * @return Response
     * @internal param int $id
     */
    public function edit()
    {
        $userData = Auth::user();

        return view('users.setting', compact('userData'));
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
        $user = $this->user->find($id);

        $user->delete();

        Session::flash('status', Lang::get('alert.user_deleted'));

        return redirect()->route('admin::users.index');
    }
}
