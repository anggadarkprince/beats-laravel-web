<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * user object instance of App\User
     *
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        // this controller need to be member and authorization
        // this authorization just for 'user' level
        // show method need to be free because all people can look other user's profile
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
        // title page for meta data in web browser
        $page = 'User';

        // retrieve all users each 10 records data
        $users = $this->user->allUsers();

        return view('users.index', compact('page', 'users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $slug
     * @return Response
     */
    public function show($slug)
    {
        $name = str_replace('-', ' ', $slug);

        $userData = $this->user->where('name', 'like', '%' . $name . '%')->firstOrFail();

        // get playlist related by this user (hasMany)
        // user-playlist has one-to-many relationship where one user has many playlist
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
        // get current logged in user
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
        // rules for validation
        // new password must be confirmed
        // every update step always required input old password
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required',
            'password_old' => 'required|check_password',
            'password_new' => 'confirmed|min:6'
        ];
        $messages = ['check_password' => 'The old password mismatch with current password'];
        $validator = Validator::make($request->all(), $rules, $messages);

        // check validation process pass or fail
        if ($validator->fails()) {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', Lang::get('alert.unvalidated'));

            $this->throwValidationException(
                $request, $validator
            );
        }

        // upload avatar by request
        // return false if upload operation was fail
        $this->_uploadAvatar($request);

        // if password_new field is set so user has initiate to change password
        if ($request->has('password_new')) {
            $request->merge(['password' => Hash::make($request->input('password_new'))]);
        }

        // save modified user by related data which retrieved
        $user->fill($request->all())->save();

        return redirect()
            ->route('private_setting')
            ->with('status', 'success')
            ->with('message', Lang::get('alert.setting_updated'));
    }

    /**
     * @param Request $request
     */
    private function _uploadAvatar(Request $request)
    {
        // modified uploaded filename by id because user id always unique
        $fileName = Auth::user()->id;

        // passing all attributed to upload helper
        $upload = upload_file($request, 'avatar_file', base_path('public/img/avatar/'), $fileName);

        if ($upload['status']) {
            $request->merge(['avatar' => $upload['filename']]);
        }

        return $upload['status'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        // retrieve single data of user by id, prepare for Eloquent model
        // if a unregistered id has been given by client then fail and return null object
        $user = $this->user->find($id);

        // delete album by related data which retrieved
        $user->delete();

        return redirect()
            ->route('admin::users.index')
            ->with('status', Lang::get('alert.user_deleted'));
    }
}
