<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/',[\App\Http\Controllers\MainController::class,'index'])->name('main');
Route::get('/search/',[\App\Http\Controllers\MainController::class,'search'])->name('search');

//manager route
Route::prefix('manager')->middleware('checkrole')->group(function (){
    Route::get('/',[\App\Http\Controllers\admin\AdminController::class,'index'])->name('admin');
    Route::get('/users',[\App\Http\Controllers\admin\UserController::class,'index'])->name('admin.users');
    Route::get('/profile/{user}',[\App\Http\Controllers\admin\UserController::class,'edit'])->name('admin.profile');
    Route::post('/profile_update/{user}',[\App\Http\Controllers\admin\UserController::class,'update'])->name('admin.update_profile');
    Route::get('/users/delete/{user}',[\App\Http\Controllers\admin\UserController::class,'destroy'])->name('admin.user.delete');
    Route::get('/users/status/{user}',[\App\Http\Controllers\admin\UserController::class,'status'])->name('admin.user.status');

    Route::get('/doctors',[\App\Http\Controllers\admin\DoctorController::class,'index'])->name('admin.doctors');
    Route::get('doctor/profile/{doctor}',[\App\Http\Controllers\admin\DoctorController::class,'edit'])->name('admin.doctor.profile');
    Route::post('doctor/profile_update/{doctor}',[\App\Http\Controllers\admin\DoctorController::class,'update'])->name('admin.doctor.update_profile');
    Route::get('/doctors/delete/{doctor}',[\App\Http\Controllers\admin\DoctorController::class,'destroy'])->name('admin.doctor.delete');
    Route::get('/doctors/status/{doctor}',[\App\Http\Controllers\admin\DoctorController::class,'status'])->name('admin.doctor.status');


    Route::get('/secretaries',[\App\Http\Controllers\admin\SecretaryController::class,'index'])->name('admin.secretaries');
    Route::get('secretary/profile/{secretary}',[\App\Http\Controllers\admin\SecretaryController::class,'edit'])->name('admin.secretary.profile');
    Route::post('secretary/profile_update/{secretary}',[\App\Http\Controllers\admin\SecretaryController::class,'update'])->name('admin.secretary.update_profile');
    Route::get('/secretary/delete/{secretary}',[\App\Http\Controllers\admin\SecretaryController::class,'destroy'])->name('admin.secretary.delete');
    Route::get('/secretary/status/{secretary}',[\App\Http\Controllers\admin\SecretaryController::class,'status'])->name('admin.secretary.status');


});

//manager category route
Route::prefix('manager/categories')->middleware('checkrole')->group(function (){
    Route::get('/',[\App\Http\Controllers\admin\CategoryController::class,'index'])->name('admin.categories');
    Route::get('/create',[\App\Http\Controllers\admin\CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('/store',[\App\Http\Controllers\admin\CategoryController::class,'store'])->name('admin.categories.store');
    Route::get('/edit/{category}',[\App\Http\Controllers\admin\CategoryController::class,'edit'])->name('admin.categories.edit');
    Route::post('/update/{category}',[\App\Http\Controllers\admin\CategoryController::class,'update'])->name('admin.categories.update');
    Route::get('/destroy/{category}',[\App\Http\Controllers\admin\CategoryController::class,'destroy'])->name('admin.categories.destroy');

});

//manager article route
Route::prefix('manager/articles')->middleware('checkrole')->group(function (){
    Route::get('/',[\App\Http\Controllers\admin\ArticleController::class,'index'])->name('admin.article');
    Route::get('/create',[\App\Http\Controllers\admin\ArticleController::class,'create'])->name('admin.article.create');
    Route::post('/store',[\App\Http\Controllers\admin\ArticleController::class,'store'])->name('admin.article.store');
    Route::get('/edit/{article}',[\App\Http\Controllers\admin\ArticleController::class,'edit'])->name('admin.article.edit');
    Route::post('/update/{article}',[\App\Http\Controllers\admin\ArticleController::class,'update'])->name('admin.article.update');
    Route::get('/destroy/{article}',[\App\Http\Controllers\admin\ArticleController::class,'destroy'])->name('admin.article.destroy');

});

//user profile
Route::get('/profile/{user}',[\App\Http\Controllers\UserController::class,'edit'])->name('profile')->middleware('auth:web');
Route::post('/update/{user}',[\App\Http\Controllers\UserController::class,'update'])->name('update_profile')->middleware('auth:web');

//doctor route

//doctor login route
Route::get('doctor/login',[\App\Http\Controllers\Auth\DoctorLoginController::class,'showLoginForm']);
Route::post('doctor/login',[\App\Http\Controllers\Auth\DoctorLoginController::class,'login'])->name('doctor.login');
Route::get('doctor/dashboard',[\App\Http\Controllers\DoctorController::class,'index'])->name('doctor.dashboard')->middleware('auth:doctor');

//doctor register route
Route::get('doctor/register',[\App\Http\Controllers\Auth\DoctorRegisterController::class,'showRegistrationForm']);
Route::post('doctor/register',[\App\Http\Controllers\Auth\DoctorRegisterController::class,'register'])->name('doctor.register');

//doctor page route
Route::get('/doctor/{id}',[\App\Http\Controllers\DoctorController::class,'doctor'])->name('doctor');

//doctor time page
//Route::get('doctor/dashboard/Scheduling/{id?}',[\App\Http\Controllers\DoctorController::class,'Scheduling'])->name('doctor.dashboard.Scheduling')->middleware('auth:doctor');
Route::get('doctor/dashboard/Scheduling/{id?}',[\App\Http\Controllers\TimeController::class,'create'])->name('doctor.dashboard.Scheduling')->middleware('auth:doctor');
Route::post('doctor/dashboard/Scheduling/store',[\App\Http\Controllers\TimeController::class,'store'])->name('doctor.dashboard.Scheduling.store');
Route::get('doctor/dashboard/destroy/{id}',[\App\Http\Controllers\TimeController::class,'destroy'])->name('doctor.dashboard.scheduling.destroy');

Route::get('/doctor/status/{time}',[\App\Http\Controllers\DoctorController::class,'status'])->name('doctor.status');

//doctor clinic
Route::get('doctor/dashboard/clinic/{id}',[\App\Http\Controllers\ClinicController::class,'create'])->name('doctor.dashboard.clinic')->middleware('auth:doctor');
Route::post('doctor/dashboard/clinic/store',[\App\Http\Controllers\ClinicController::class,'store'])->name('doctor.dashboard.clinic.store')->middleware('auth:doctor');
Route::get('doctor/dashboard/clinic/destroy/{id}',[\App\Http\Controllers\ClinicController::class,'destroy'])->name('doctor.dashboard.clinic.destroy')->middleware('auth:doctor');
Route::get('doctor/dashboard/clinic/edit/{clinic}',[\App\Http\Controllers\ClinicController::class,'edit'])->name('doctor.dashboard.clinic.edit')->middleware('auth:doctor');
Route::post('doctor/dashboard/clinic/update/{clinic}',[\App\Http\Controllers\ClinicController::class,'update'])->name('doctor.dashboard.clinic.update')->middleware('auth:doctor');

//doctor profile
Route::get('doctor/dashboard/profile/{doctor}',[\App\Http\Controllers\DoctorController::class,'edit'])->name('doctor.dashboard.profile.edit')->middleware('auth:doctor');
Route::post('doctor/dashboard/profile/update/{doctor}',[\App\Http\Controllers\DoctorController::class,'update'])->name('doctor.dashboard.profile.update')->middleware('auth:doctor');

//user route
Route::get('user/dashboard',[\App\Http\Controllers\UserController::class,'index'])->name('user.dashboard')->middleware('auth:web');

//user insurance
Route::get('user/dashboard/insurance',[\App\Http\Controllers\InsuranceController::class,'create'])->name('user.dashboard.insurance')->middleware('auth:web');
Route::post('user/dashboard/insurance/store',[\App\Http\Controllers\InsuranceController::class,'store'])->name('user.dashboard.insurance.store')->middleware('auth:web');
Route::get('user/dashboard/insurance/destroy/{id}',[\App\Http\Controllers\InsuranceController::class,'destroy'])->name('user.dashboard.insurance.destroy')->middleware('auth:web');

//user detail insurance
Route::get('user/dashboard/insurance/detail',[\App\Http\Controllers\DetailController::class,'create'])->name('user.dashboard.insurance.detail')->middleware('auth:web');
Route::post('user/dashboard/insurance/detail/store',[\App\Http\Controllers\DetailController::class,'store'])->name('user.dashboard.insurance.detail.store')->middleware('auth:web');
Route::get('user/dashboard/insurance/detail/destroy/{id}',[\App\Http\Controllers\DetailController::class,'destroy'])->name('user.dashboard.insurance.detail.destroy')->middleware('auth:web');

//user turn
Route::get('user/turn/{id}',[\App\Http\Controllers\TurnController::class,'create'])->name('user.turn');
Route::post('user/turn/store',[\App\Http\Controllers\TurnController::class,'store'])->name('user.turn.store');


Route::get('user/dashboard/reserve',[\App\Http\Controllers\TurnController::class,'reserve'])->name('user.dashboard.reserve')->middleware('auth:web');

Route::get('doctor/dashboard/reserve/{id}',[\App\Http\Controllers\DoctorController::class,'doctor_reserve'])->name('doctor.dashboard.reserve')->middleware('auth:doctor');

//secretary login route
Route::get('secretary/login',[\App\Http\Controllers\Auth\SecretaryLoginController::class,'showLoginForm']);
Route::post('secretary/login',[\App\Http\Controllers\Auth\SecretaryLoginController::class,'login'])->name('secretary.login');
Route::get('secretary/dashboard',[\App\Http\Controllers\SecretaryController::class,'index'])->name('secretary.dashboard')->middleware('auth:secretary');

//secretary register route
Route::get('doctor/dashboard/secretary/register/{id}',[\App\Http\Controllers\Auth\SecretaryRegisterController::class,'showRegistrationForm'])->name('show.register');
Route::post('doctor/dashboard/secretary/register',[\App\Http\Controllers\Auth\SecretaryRegisterController::class,'register'])->name('secretary.register');

//secretary scheduling
Route::get('secretary/dashboard/scheduling/{id}',[\App\Http\Controllers\SecretaryController::class,'scheduling'])->name('secretary.dashboard.scheduling');
Route::post('secretary/dashboard/Scheduling/store',[\App\Http\Controllers\SecretaryController::class,'store'])->name('secretary.dashboard.Scheduling.store');
Route::get('secretary/dashboard/destroy/{id}',[\App\Http\Controllers\SecretaryController::class,'destroy'])->name('secretary.dashboard.scheduling.destroy');

//secretary profile
Route::get('secretary/dashboard/profile/{secretary}',[\App\Http\Controllers\SecretaryController::class,'edit'])->name('secretary.dashboard.profile')->middleware('auth:secretary');
Route::post('secretary/dashboard/update/{secretary}',[\App\Http\Controllers\SecretaryController::class,'update'])->name('secretary.dashboard.update_profile')->middleware('auth:secretary');

//secretary delete
Route::get('doctor/dashboard/secretary/destroy/{secretary}',[\App\Http\Controllers\Auth\SecretaryRegisterController::class,'destroy'])->name('doctor.dashboard.secretary.destroy');

//secretary edit
Route::get('doctor/dashboard/secretary/profile/{secretary}',[\App\Http\Controllers\Auth\SecretaryRegisterController::class,'edit'])->name('doctor.dashboard.secretary.profile');
Route::post('doctor/dashboard/secretary/profile_update/{secretary}',[\App\Http\Controllers\Auth\SecretaryRegisterController::class,'update'])->name('doctor.dashboard.secretary.update_profile');


//secretary reserve
Route::get('secretary/dashboard/reserve/{secretary}',[\App\Http\Controllers\SecretaryController::class,'reserve'])->name('secretary.dashboard.reserve')->middleware('auth:secretary');



//doctor reset password
Route::post('doctor/password/email',[\App\Http\Controllers\Auth\DoctorForgotPasswordController::class,'sendResetLinkEmail'])->name('doctor.password.email');
Route::get('doctor/password/reset',[\App\Http\Controllers\Auth\DoctorForgotPasswordController::class,'showLinkRequestForm'])->name('doctor.password.request');
Route::post('doctor/password/reset',[\App\Http\Controllers\Auth\DoctorResetPasswordController::class,'reset'])->name('doctor.password.update');
Route::get('doctor/password/reset/{token}',[\App\Http\Controllers\Auth\DoctorResetPasswordController::class,'showResetForm'])->name('doctor.password.reset');

//secretary reset password
Route::post('secretary/password/email',[\App\Http\Controllers\Auth\SecretaryForgotPasswordController::class,'sendResetLinkEmail'])->name('secretary.password.email');
Route::get('secretary/password/reset',[\App\Http\Controllers\Auth\SecretaryForgotPasswordController::class,'showLinkRequestForm'])->name('secretary.password.request');
Route::post('secretary/password/reset',[\App\Http\Controllers\Auth\SecretaryResetPasswordController::class,'reset'])->name('secretary.password.update');
Route::get('secretary/password/reset/{token}',[\App\Http\Controllers\Auth\SecretaryResetPasswordController::class,'showResetForm'])->name('secretary.password.reset');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


