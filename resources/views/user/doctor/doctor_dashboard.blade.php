


@extends('layouts.app')
@section('title')
    داشبورد
@endsection
@section('content')
    @php $id = Auth::user()->id @endphp
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
                                {{ Auth::user()->name }}
                                {{ Auth::user()->family }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('doctor.dashboard')}}">
                                    {{ __('داشبورد') }}
                                </a>
                                <a class="dropdown-item" href="{{route('doctor.dashboard.profile.edit',$id)}}">
                                    {{ __('ویرایش پروفایل') }}
                                </a>
                                <a class="dropdown-item" href="{{route('show.register',$id)}}">
                                    {{ __('مدیریت منشی') }}
                                </a>
                                <a class="dropdown-item" href="{{route('doctor.dashboard.clinic',$id)}}">
                                    {{ __('مدیریت مطب') }}
                                </a>
                                @foreach($doctors as $doctor)
                                    @if($id==$doctor->id)
                                        <a class="dropdown-item"
                                           href="{{route('doctor.dashboard.Scheduling',$doctor->id)}}">
                                            {{ __('مدیریت زمانبندی') }}
                                        </a>
                                    @endif
                                @endforeach
                                <a class="dropdown-item" href="{{route('doctor.dashboard.reserve',$id)}}">
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
                    <div class="card-header card-header-color text-white">{{ __('داشبورد پزشک') }}</div>

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
                        <a href="{{route('doctor.dashboard.profile.edit',$id)}}" class="btn btn-sm card-header-color text-white mt-1">
                            ویرایش پروفایل
                        </a>
                        <a href="{{route('show.register',$id)}}" class="btn btn-sm my-color text-white mt-1">
                            مدیریت منشی
                        </a>

                        <a href="{{route('doctor.dashboard.clinic',$id)}}" class="btn btn-sm red-color text-white mt-1">
                            مدیریت مطب
                        </a>

                        @foreach($doctors as $doctor)
                            @if($id==$doctor->id)
                                <a href="{{route('doctor.dashboard.Scheduling',$doctor->id)}} "
                                   class="btn btn-sm button-color1 text-white mt-1">
                                    مدیریت زمانبندی
                                </a>

                            @endif
                        @endforeach
                        <a href="{{route('doctor.dashboard.reserve',$id)}}" class="btn btn-sm text-white mt-1" style="background: #f5487f">
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
                                @if($time->doctor_id == $id)
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



{{--                            @php $counter=0; @endphp--}}
{{--                            @foreach($times as $time)--}}
{{--                                @if($time->doctor_id == $id)--}}
{{--                                    @if($counter == 0)--}}
{{--                                        @php $counter=1; @endphp--}}
{{--                                        @foreach($turns as $turn)--}}
{{--                                            @if($turn->user_id  == $time->user_id )--}}
{{--                                                <tr>--}}
{{--                                                    --}}{{--                                                    <td>{{$turn->id}}</td>--}}
{{--                                                    @foreach($clinics as $clinic)--}}
{{--                                                        @if($time->clinic_id == $clinic->id)--}}
{{--                                                            <td>{{$clinic->name}}</td>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                    @foreach($users as $user)--}}
{{--                                                        @if($turn->user_id == $user->id)--}}
{{--                                                            <td>{{$user->name}} {{$user->family}} </td>--}}
{{--                                                            <td>{{$user->phone}}</td>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                    <td>{{$turn->date}}</td>--}}
{{--                                                    <td>{{$turn->time}}</td>--}}
{{--                                                </tr>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
{{--                                        @break--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                            @endforeach--}}

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
