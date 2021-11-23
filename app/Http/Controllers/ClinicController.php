<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        return view('user.doctor.doctor_dashboard_clinic', compact('clinics', 'id', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $massages = [
            'id.numeric' => 'کد مطب فقط شامل اعداد می‌باشد.',
            'code.numeric' => 'کد مرکز درمانی فقط شامل اعداد می‌باشد.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
//            'doctor_id.numeric' => 'کدملی فقط شامل اعداد می‌باشد.',
//            'doctor_id.exists' => 'کدملی وارد شده نامعتبر است.',
        ];
        $validatedData = $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'code' => ['required', 'numeric'],
            'type' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
//            'doctor_id' => ['required','exists:doctors','numeric'],
        ], $massages);

        $clincs = new Clinic();
        //$times->create($request->all());
        $clincs = $clincs->create([
            'id' => $request['id'],
            'name' => $request['name'],
            'code' => $request['code'],
            'type' => $request['type'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'doctor_id' => $request['doctor_id'],
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        $doctors = Doctor::orderBy('id')->get();
        return view('user.doctor.doctor_dashboard_clinic_edit', compact('clinic', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        $massages = [
            'id.numeric' => 'کد مطب فقط شامل اعداد می‌باشد.',
            'code.numeric' => 'کد مرکز درمانی فقط شامل اعداد می‌باشد.',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
        ];

        $validatedData = $request->validate([
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string'],
            'code' => ['required', 'numeric'],
            'type' => ['required'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
        ], $massages);

        $clinic->id = $request->id;
        $clinic->name = $request->name;
        $clinic->type = $request->type;
        $clinic->code = $request->code;
        $clinic->phone = $request->phone;
        $clinic->address = $request->address;
        $clinic->doctor_id = $request->doctor_id;

        try {
            $clinic->save();
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
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Clinic $clinic)
    {
        $clinic->destroy($id);
        return redirect()->back();

    }
}
