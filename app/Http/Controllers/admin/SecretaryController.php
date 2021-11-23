<?php

namespace App\Http\Controllers\admin;

use App\Models\Secretary;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretaries=Secretary::orderBy('id')->get();
        return view('admin.secretary.secretaries',compact('secretaries'));
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Secretary $secretary)
    {
        return view('admin.secretary.profile', compact( 'secretary'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secretary $secretary)
    {
        $secretary->delete();
        return redirect(route('admin.secretaries'));
    }

    public function status(User $user){
        if ($user->status==0){
            $user->status=1;
        }else{
            $user->status=0;
        }
        $user->save();
        return redirect(route('admin.users'));
    }
}
