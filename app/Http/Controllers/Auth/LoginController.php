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
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|numeric',
            'password' => 'required',
        ]);

        $dataLogin = [
            'phone_number' => $request->get('phone_number'),
            'password' => $request->get('password')
        ];

        $remember_me  = (!empty($request->remember_me)) ? TRUE : FALSE;

        if (auth()->attempt($dataLogin)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')
                ->with('error', 'Phone Number And Password Are Wrong.');
        }
    }
}
