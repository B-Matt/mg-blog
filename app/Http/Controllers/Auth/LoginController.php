<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Logs in user and shows dashboard.
     * 
     * @return redirect
     */
    public function login(Request $request)
    {  
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $input = $request->all();
  
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            return redirect()->route('dash.index');
        }
        else
        {
            return redirect()->route('login')->with('error','Sorry the credentials you are using are invalid.');
        }
    }
}
