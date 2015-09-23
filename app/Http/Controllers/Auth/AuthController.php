<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // when login success
    protected $redirectPath = '/';

    // when login fail
    protected $loginPath = '/auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'agree' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'level' => 'USER'
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        $page = "Sign In";

        return view('auth.login', compact('page'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $slug = str_slug(Auth::user()->name);
            $this->redirectPath = $slug;
            return redirect()->intended($slug);
        }

        $request->session()->flash('status', $this->getFailedLoginMessage());

        return redirect($this->loginPath)->withInput();
    }

    /**
     * logout authenticated user
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('public_sign_in');
    }

    /**
     * show register page
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        $page = "Register";

        return view('auth.register', compact('page'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $request->session()->flash('status', Lang::get('auth.invalid'));
            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($this->create($request->all())){
            $request->session()->flash('status', Lang::get('auth.registered'));
            return redirect()->route('public_sign_in');
        }
        else{
            $request->session()->flash('status', Lang::get('auth.error'));
            return redirect()->route('public_sign_up');
        }
    }

}
