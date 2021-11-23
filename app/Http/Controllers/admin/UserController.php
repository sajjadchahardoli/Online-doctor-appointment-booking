<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id')->paginate(10);
        return view('admin.users.users',compact('users'));
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
    public function edit(User $user)
    {
        return view('admin.users.profile', compact( 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $messages = [
            'name.require' => 'نام خود را وارد كنيد',
            'family.require' => 'نام خانوادگي خود را وارد كنيد',
            'name.alpha' => 'نام فقط شامل حروف می‌باشد.',
            'family.alpha' => 'نام خانوادگی فقط شامل حروف می‌باشد.',
            'id.require' => 'كدملي خود را وارد كنيد',
            'email.require ' => 'ايميل خود را وارد كنيد',
            'phone.require ' => 'شماره تلفن خود را وارد كنيد',
            'phone.numeric' => 'شماره تماس فقط شامل اعداد می‌باشد.',
            'password.min' => 'رمز عبور باید ۸ کاراکتر باشد.',

        ];

        if (!empty($request->password)) {
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'email' => ['required', 'email'],
                'phone' => ['required', 'numeric'],
                'password'=> 'min:8',
                'password_confirmation'=> 'min:8',
            ], $messages);
            $password = Hash::make($request->password);
            $user->password = $password;
        } else{
            $validatedData = $request->validate([
                'name' => ['required','alpha'],
                'family' => ['required','alpha'],
                'id' => 'required',
                'email' => ['required', 'email'],
                'phone' => ['required', 'numeric'],
            ], $messages);
        }

        $user->name = $request->name;
        $user->family = $request->family;
        $user->id = $request->id;
        $user->email = $request->email;
        $user->phone = $request->phone;


        try {
            $user->save();
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
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users'));
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
