<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use App\Models\Doctor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorRegisterController extends Controller
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
            'id.unique' => 'کدملی وارد شده تکراری است.',
            'id.numeric' => 'کدملی فقط شامل اعداد می‌باشد.',
            'medical_system_number.numeric' => 'کد نظام پزشکی فقط شامل اعداد می‌باشد.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
            'email.unique' => 'ایمیل وارد شده تکراری است.',
            'password.min' => 'رمز وارد شده باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور وارد شده مطابقت ندارد.',
        ];
        return Validator::make($data, [
            'id' => ['required','unique:doctors','numeric'],
            'name' => ['required'],
            'family' => ['required'],
            'gender' => ['required'],
            'specialty' => ['required'],
            'medical_system_number' => ['required', 'numeric'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email', 'unique:doctors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Doctor
     */
    protected function create(array $data)
    {
        return Doctor::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'family' => $data['family'],
            'gender' => $data['gender'],
            'specialty' => $data['specialty'],
            'medical_system_number' => $data['medical_system_number'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $msg = 'ثبت نام با موفقیت انجام شد';
        return redirect(route('doctor.login'))->with('success',$msg);
    }

    public function showRegistrationForm()
    {
        $categories = Category::orderBy('id')->get();
        return view('auth.doctor_register',compact('categories'));
    }
}

