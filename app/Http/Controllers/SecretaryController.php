<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Secretary;
use App\Models\Time;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretaryController extends Controller
{
    public function index()
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $turns = Turn::orderBy('date')->get();
        $times = Time::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('user.secretary.secretary_dashboard', compact('clinics','doctors','turns','times','users'));
    }

    public function reserve(Secretary $secretary)
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $turns = Turn::orderBy('date')->get();
        $times = Time::orderBy('id')->get();
        $users = User::orderBy('id')->get();
        return view('user.secretary.secretary_dashboard_reserve', compact('clinics','doctors','turns','times','users','secretary'));
    }

    public function scheduling($id)
    {
        $clinics = Clinic::orderBy('id')->get();
        $secretaries = Secretary::orderBy('id')->get();
        $times = Time::orderBy('id')->get();
        return view('user.secretary.secretary_dashboard_scheduling',compact('clinics', 'secretaries', 'times','id'));
    }


    public function store(Request $request)
    {
        $massages = [
            'date.after' => 'تاریخ وارد شده نامعتبر است.',
//            'doctor_id.numeric' => 'کدملی فقط شامل اعداد می‌باشد.',
//            'doctor_id.exists' => 'کدملی وارد شده نامعتبر است.',
        ];
        $validatedData = $request->validate([
            'date' => ['required','after:today'],
            'time' => ['required'],
            'status' => ['required'],
//            'doctor_id' => ['required','exists:doctors','numeric'],
            'clinic_id' => ['required'],
        ],$massages);

        $times = new Time();
        //$times->create($request->all());
        $times->create([
            'date' => $request['date'],
            'time' => $request['time'],
            'status' => $request['status'],
            'doctor_id' => $request['doctor_id'],
            'clinic_id' => $request['clinic_id'],
        ]);

        //Auth::user()->id;

        return redirect(route('secretary.dashboard.scheduling'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Time $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Time $time)
    {
        //$id = Time::all()->pluck('id');

        $time->destroy($id);
        return redirect(route('secretary.dashboard.scheduling'));
    }

    public function edit(Secretary $secretary)
    {
        return view('user.secretary.secretary_profile', compact( 'secretary'));

    }

    public function update(Request $request, Secretary $secretary)
    {
        $messages = [
            'name.require' => 'نام خود را وارد كنيد',
            'family.require' => 'نام خانوادگي خود را وارد كنيد',
            'name.alpha' => 'نام فقط شامل حروف می‌باشد.',
            'family.alpha' => 'نام خانوادگی فقط شامل حروف می‌باشد.',
            'id.require' => 'كدملي خود را وارد كنيد',
            'email.require ' => 'ايميل خود را وارد كنيد',
            'doctor_id.require ' => 'شناسه پزشک  را وارد كنيد',
            'clinic_id.require ' => 'شناسه کلنیک وارد كنيد',
            'password.min' => 'رمز عبور باید ۸ کاراکتر باشد.',

        ];

        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'email' => 'required',
                'doctor_id' => 'required',
                'clinic_id' => 'required',
                'password'=> 'min:8',
                'password_confirmation'=> 'min:8',
            ], $messages);
            $password = Hash::make($request->password);
            $secretary->password = $password;
        } else{
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'email' => 'required',
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

}
