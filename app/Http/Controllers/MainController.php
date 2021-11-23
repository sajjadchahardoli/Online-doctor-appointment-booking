<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\Doctor;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id')->get();
        $clinics = Clinic::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();
        return view('user.index',compact('doctors','clinics','categories'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $answers = Doctor::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('family', 'LIKE', "%{$search}%" )
            ->orWhere('specialty', 'LIKE', "%{$search}%")
            ->orWhere('gender', 'LIKE', "%{$search}%")
            ->get();

        $clinics = Clinic::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();
        return view('user.search', compact('answers','clinics','categories'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
