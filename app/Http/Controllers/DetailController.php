<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Insurance;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurances = Insurance::orderBy('id')->get();
        $details = Detail::orderBy('id')->get();
        return view('user.patient.user_dashboard_insurance_detail',compact('insurances','details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $massages = [
            'name.required' =>'نام بیمه شونده را وارد کنید.',
            'family.required' =>'نام خانوادگی بیمه شونده را وارد کنید.',
            'date.after' => 'تاریخ اعتبار وارد شده نامعتبر است.',

        ];
        $validatedData = $request->validate([
            'name' => ['required'],
            'family' => ['required'],
            'date' => ['required','after:today'],

        ],$massages);
        $detail = new Detail();
        $detail->create($request->all());
        return redirect(route('user.dashboard.insurance.detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail,$id)
    {
        $detail->destroy($id);
        return redirect(route('user.dashboard.insurance.detail'));
    }
}
