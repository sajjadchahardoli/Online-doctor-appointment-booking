<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'email.unique' => 'ایمیل وارد شده تکراری است.',
            'password.min' => 'رمز وارد شده باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور وارد شده مطابقت ندارد.',
            'id.numeric' => 'کدملی فقط شامل اعداد می‌باشد.',
            'id.unique' => 'کدملی وارد شده تکراری است.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
        ];
        return Validator::make($data, [
            'name' => ['required'],
            'family' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id' => ['required', 'numeric', 'unique:users',],
            'phone' => ['required', 'numeric'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'family' => $data['family'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id' => $data['id'],
            'phone' => $data['phone'],
        ]);
        $msg = 'ثبت نام با موفقیت انجام شد';
        return redirect(route('login'))->with('success',$msg);
    }

  /*  public function showRegistrationForm()
    {
        return view('user.auth.register');
    } */
}
