<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DoctorLoginController extends Controller
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
    protected $redirectTo = '/doctor/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('guest:doctor')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.doctor_login');
    }

   public function username()
    {
        return 'id';
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }

    /* public function showDoctorLoginForm()
     {
         return view('user.auth.login',['url' => 'doctor']);
     }

     public function doctorLogin(Request $request)
     {
         $this->validate($request, [
             'email' => 'required|email',
             'password' => 'required|min:6'
         ]);

         if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

             return redirect()->intended('/doctor');
         }
         return back()->withInput($request->only('email', 'remember'));
     }
    */
}

