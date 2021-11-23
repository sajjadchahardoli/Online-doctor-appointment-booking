<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Time;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use Auth;
class TimeController extends Controller
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
    public function create()
    {
        $clinics = Clinic::orderBy('id')->get();
        $doctors = Doctor::orderBy('id')->get();
        $turns = Turn::orderBy('id')->get();
        $times = Time::orderBy('date')->get();
        $users = User::orderBy('id')->get();
        return view('user.doctor.doctor_dashboard_scheduling',compact('clinics','doctors','turns','times','users'));
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

        return redirect(route('doctor.dashboard.Scheduling'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Time $time
     * @return \Illuminate\Http\Response
     */
    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Time $time
     * @return \Illuminate\Http\Response
     */
    public function edit(Time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Time $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Time $time)
    {
        //
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
        return redirect(route('doctor.dashboard.Scheduling'));
    }
}
