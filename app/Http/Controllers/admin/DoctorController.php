<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id')->get();
        return view('admin.doctor.doctor',compact('doctors'));
    }

    public function status(Doctor $doctor){
        if ($doctor->status==0){
            $doctor->status=1;
        }else{
            $doctor->status=0;
        }
        $doctor->save();
        return redirect(route('admin.doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $categories = Category::orderBy('id')->get();
        return view('admin.doctor.profile', compact( 'doctor','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $messages = [
            'name.require' => 'نام خود را وارد كنيد',
            'family.require' => 'نام خانوادگي خود را وارد كنيد',
            'name.alpha' => 'نام فقط شامل حروف می‌باشد.',
            'family.alpha' => 'نام خانوادگی فقط شامل حروف می‌باشد.',
            'id.require' => 'كدملي خود را وارد كنيد',
            'email.require ' => 'ايميل خود را وارد كنيد',
            'phone.require ' => 'شماره تلفن خود را وارد كنيد',
            'medical_system_number.require' => 'شماره نظام پزشکی را وارد کنید',
            'medical_system_number.numeric' => 'شماره نظام پزشکی فقط شامل اعداد می‌باشد.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
            'password.min' => 'رمز عبور باید ۸ کاراکتر باشد.',
        ];

        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'medical_system_number' => ['required', 'numeric'],
                'email' => 'required',
                'phone' => ['required', 'numeric'],
                'password'=> 'min:8',
                'password_confirmation'=> 'min:8',
            ], $messages);
            $password = Hash::make($request->password);
            $doctor->password = $password;
        } else{
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'medical_system_number' => ['required', 'numeric'],
                'email' => 'required',
                'phone' => ['required', 'numeric'],
            ], $messages);
        }

        $doctor->name = $request->name;
        $doctor->family = $request->family;
        $doctor->id = $request->id;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect(route('admin.users'));
    }
}
