
@extends('layouts.app')
@section('title')
    داشبورد
@endsection
@section('content')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="text-secondary" style="text-decoration: none" href="{{ url('/') }}">
                صفحه اصلی
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} {{ Auth::user()->family }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('secretary.dashboard')}}">
                                    {{ __('داشبورد') }}
                                </a>
                                <a class="dropdown-item" href="{{route('secretary.dashboard.profile',auth()->user()->id)}}">
                                    {{ __('ویرایش پروفایل') }}
                                </a>
                                <a class="dropdown-item" href="{{route('secretary.dashboard.scheduling',auth()->user()->id)}}">
                                    {{ __('مدیریت زمانبندی') }}
                                </a>
                                <a class="dropdown-item" href="{{route('secretary.dashboard.reserve',auth()->user()->id)}}">
                                    {{ __('لیست بیماران') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('خروج از حساب کاربری') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('داشبورد منشی') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        {{Auth::user()->name}}
                        {{Auth::user()->family}}
                        {{ __('عزیز خوش آمدید.') }}
                        <br>
                        {{--                        {{ __('شما با کدملی ') }}--}}
                        {{--                        @php $id = Auth::user()->id @endphp--}}
                        {{--                        {{ __('وارد شده‌اید.') }}--}}
                        <br>
                        <br>
                        <a href="{{route('secretary.dashboard.profile',auth()->user()->id)}}" class="btn btn-sm card-header-color text-white mt-1">
                            ویرایش پروفایل
                        </a>
                        <a href="{{route('secretary.dashboard.scheduling',auth()->user()->id)}}" class="btn btn-sm  my-color text-white mt-1">
                            مدیریت زمانبندی
                        </a>

                        <a href="{{route('secretary.dashboard.reserve',auth()->user()->id)}}" class="btn btn-sm red-color text-white mt-1">
                            لیست بیماران
                        </a>


                    </div>
                </div>


            </div>
        </div>

        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('لیست بیماران') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="address-box-color">
                            <tr>
                                {{--                                <th>آیدی</th>--}}
                                <th>نام مطب</th>
                                <th>نام بیمار</th>
                                <th>شماره تماس</th>
                                <th>تاریخ</th>
                                <th>ساعت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($times as $time)
                                @if($time->doctor_id == auth()->user()->doctor_id & $time->clinic_id == auth()->user()->clinic_id)
                                    @foreach($turns as $turn)
                                        @if($turn->user_id  == $time->user_id & $turn->date == $time->date & $turn->time == $time->time)
                                            <tr>
                                                @foreach($clinics as $clinic)
                                                    @if($time->clinic_id == $clinic->id)
                                                        <td>{{$clinic->name}}</td>
                                                    @endif
                                                @endforeach
                                                @foreach($users as $user)
                                                    @if($turn->user_id == $user->id)
                                                        <td>{{$user->name}} {{$user->family}} </td>
                                                        <td>{{$user->phone}}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{$turn->date}}</td>
                                                <td>{{$turn->time}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>



    </div>
@endsection
