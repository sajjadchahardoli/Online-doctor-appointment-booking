<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\Secretary;
use App\Providers\RouteServiceProvider;
use App\Models\Doctor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SecretaryRegisterController extends Controller
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
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'id.unique' => 'کدملی وارد شده تکراری است.',
            'id.numeric' => 'کدملی فقط شامل اعداد می‌باشد.',
            'email.unique' => 'ایمیل وارد شده تکراری است.',
            'password.min' => 'رمز وارد شده باید حداقل ۸ کاراکتر باشد.',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور وارد شده مطابقت ندارد.',
        ];
        return Validator::make($data, [
            'id' => ['required', 'unique:secretaries', 'numeric'],
            'name' => ['required'],
            'family' => ['required'],
            'email' => ['required', 'email', 'unique:secretaries'],
            'doctor_id' => ['required'],
            'clinic_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\Secretary
     */
    protected function create(array $data)
    {
        return Secretary::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'family' => $data['family'],
            'email' => $data['email'],
            'doctor_id' => $data['doctor_id'],
            'clinic_id' => $data['clinic_id'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm($id)
    {
        $secretaries = Secretary::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $clinics = Clinic::orderBy('id')->get();
        return view('auth.secretary_register',compact('secretaries','id','doctors','clinics'));
    }

    public function destroy(Secretary $secretary)
    {
        $secretary->delete();
        return redirect()->back();
    }

    public function update(Request $request, Secretary $secretary)
    {
        $messages = [
            'name.require' => 'نام خود را وارد كنيد',
            'family.require' => 'نام خانوادگي خود را وارد كنيد',
            'id.require' => 'كدملي خود را وارد كنيد',
            'email.require ' => 'ايميل خود را وارد كنيد',
            'doctor_id.require ' => 'شناسه پزشک  را وارد كنيد',
            'clinic_id.require ' => 'شناسه کلنیک وارد كنيد',
            'email.unique' => 'ایمیل وارد شده تکراری است.',

        ];

        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'name' => ['required'],
                'family' => ['required'],
                'id' => 'required',
                'email' => ['required','email'],
                'doctor_id' => 'required',
                'clinic_id' => 'required',
                'password'=> 'min:8',
                'password_confirmation'=> 'min:8',
            ], $messages);
            $password = Hash::make($request->password);
            $secretary->password = $password;
        } else{
            $validatedData = $request->validate([
                'name' => ['required'],
                'family' => ['required'],
                'id' => 'required',
                'email' => ['required','email'],
                'doctor_id' => 'required',
                'clinic_id' => 'required',
            ], $messages);
        }

        $secretary->name = $request->name;
        $secretary->family = $request->family;
        $secretary->id = $request->id;
        $secretary->email = $request->email;
        $secretary->doctor_id = $request->doctor_id;
        $secretary->clinic_id = $request->clinic_id;


        try {
            $secretary->save();
        } catch (Exception $exception){
            switch ($exception->getCode()){}
            return redirect()->back()->with('warining',$exception->getCode());

        }
        $msg = 'ويرايش با موفقيت انجا شد';
        return redirect()->back()->with('sucsses',$msg);


    }

    public function edit(Secretary $secretary)
    {
        $doctors = Doctor::orderBy('id')->get();
        return view('user.doctor.secretary_profile', compact( 'secretary','doctors'));

    }
}

