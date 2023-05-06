<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;

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
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common();

        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $isUserWithEmaill = User::where('email', $request['email'])->where('role_id', '!=', 0)->first();
        if (!$isUserWithEmaill) {

            $isUserWithUserName = User::select('name')->where('name', $request['email'])->where('role_id', '!=', 0)->first();
            if (!$isUserWithUserName) {

                $this->helper->one_time_message('danger', 'Please Check Your Email/Username and password');
                return redirect()->route('login');

            }else{
                if (\Auth::attempt(['name' => trim($isUserWithUserName->name), 'password' => trim($request['password'])])) {
                    return redirect()->route('login');
                } else {
                    $this->helper->one_time_message('danger', 'Please Check Your Email/Password');
                    return redirect()->route('login');
                }

            }
        } else {
            if (\Auth::attempt(['email' => trim($request['email']), 'password' => trim($request['password'])])) {
                return redirect()->route('login');
            } else {
                $this->helper->one_time_message('danger', 'Please Check Your Email/Password');
                return redirect()->route('login');
            }
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/login');
    }
}
