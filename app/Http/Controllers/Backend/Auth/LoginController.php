<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admins for the application and
    | redirecting them to admin dashboard screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Show the admin's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string|min:6',
        ]);
    }

    protected function redirectPath()
    {
        //return config('multiauth.redirect_after_login');
        return route('admin.dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        //$this->middleware('admin:admin', ['only' => 'showLoginForm']);
    }
}
