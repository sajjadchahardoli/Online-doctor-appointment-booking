<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id')->get();
        $clinics = Clinic::orderBy('id')->get();
        $categories = Category::orderBy('id')->get();
        return view('user.index',compact('doctors','clinics','categories'));
    }
}
