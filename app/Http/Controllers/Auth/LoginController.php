<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //函數優先於屬性
    // protected function redirectTo()
    // {
    //     return '/home';
    // }

    // public function username()
    // {
    //     // $result = filter_var( );
    //     return 'name';
    // }
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $credentialsValue = $credentials['email'];
        unset($credentials['email']);

        $account = filter_var($credentialsValue, FILTER_VALIDATE_EMAIL)?'email':'name';
        $credentials[$account] = $credentialsValue;

        return $this->guard()->attempt(
            $credentials, $request->filled('remember')
        );
    }
}
