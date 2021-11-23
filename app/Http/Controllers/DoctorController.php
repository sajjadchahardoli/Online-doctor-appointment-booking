<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Time;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function Scheduling(){
//        return view('user.doctor.doctor_dashboard_scheduling');
//    }

    public function index()
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $turns = Turn::orderBy('date')->get();
        $times = Time::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('user.doctor.doctor_dashboard', compact('clinics','doctors','turns','times','users'));
    }

    public function doctor($id)
    {
        $doctors = Doctor::orderBy('id')->get();
        $times = Time::orderBy('date')->get();
        $clinics = Clinic::orderBy('id')->get();
        return view('user.doctor.doctor', compact('id', 'doctors', 'times', 'clinics'));

    }

    public function doctor_reserve($id)
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $turns = Turn::orderBy('date')->get();
        $times = Time::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('user.doctor.doctor_dashboard_reserve',compact('clinics','doctors','turns','times','users','id'));
    }

    public function status(Time $time)
    {
        if ($time->status == 1) {
            $time->status = 2;
            $time->user_id = null;
            $time->save();
            return redirect(route('doctor',$time->doctor_id));
        } else {
            $time->status = 1;
            $time->user_id = auth()->user()->id; //پر کردن کلید خارجی زمانبندی برای کاربر عادی
        }
        $time->save();

        $id = $time->id;
        return redirect(route('user.turn',compact('id')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctors = Doctor::orderBy('id')->get();
        return view('user.doctor.doctor_profile',compact('doctors','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $messages = [
            'name.require' => 'نام خود را وارد كنيد',
            'family.require' => 'نام خانوادگي خود را وارد كنيد',
            'id.require' => 'كدملي خود را وارد كنيد',
            'email.require ' => 'ايميل خود را وارد كنيد',
            'phone.require ' => 'شماره تلفن خود را وارد كنيد',
            'medical_system_number.numeric' => 'کد نظام پزشکی فقط شامل اعداد می‌باشد.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',

        ];

        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'id' => 'required',
                'name' => ['required'],
                'family' => ['required'],
                'gender' => 'required',
                'specialty' => 'required',
                'medical_system_number' => 'required',
                'email' => ['required', 'email'],
                'phone' => ['required', 'numeric'],
                'password'=> 'min:8',
                'password_confirmation'=> 'min:8',
            ], $messages);
            $password = Hash::make($request->password);
            $doctor->password = $password;
        } else{
            $validatedData = $request->validate([
                'id' => 'required',
                'name' => ['required'],
                'family' => ['required'],
                'gender' => 'required',
                'specialty' => 'required',
                'medical_system_number' => ['required', 'numeric'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'numeric'],
            ], $messages);
        }
        $doctor->id = $request->id;
        $doctor->name = $request->name;
        $doctor->family = $request->family;
        $doctor->gender = $request->gender;
        $doctor->specialty = $request->specialty;
        $doctor->medical_system_number = $request->medical_system_number;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;


        try {
            $doctor->save();
        } catch (Exception $exception){
            switch ($exception->getCode()){}
            return redirect()->back()->with('warining',$exception->getCode());

        }
        $msg = 'ويرايش با موفقيت انجا شد';
        return redirect()->back()->with('sucsses',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
