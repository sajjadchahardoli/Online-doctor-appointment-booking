


@extends('layouts.app')
@section('title')
    داشبورد - مدیریت زمانبندی
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
                {{--            <div class="card">--}}
                {{--                <div class="card-header">{{ __('Doctor Dashboard') }}</div>--}}

                {{--                <div class="card-body">--}}
                {{--                    @if (session('status'))--}}
                {{--                        <div class="alert alert-success" role="alert">--}}
                {{--                            {{ session('status') }}--}}
                {{--                        </div>--}}
                {{--                    @endif--}}

                {{--                    {{ __('You are logged as doctor!') }}--}}
                {{--                </div>--}}
                {{--            </div>--}}

                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('ایجاد زمانبندی') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('doctor.dashboard.Scheduling.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('تاریخ') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date"
                                           class="form-control @error('date') is-invalid @enderror"
                                           name="date" value="{{ old('date') }}" required autocomplete="date" autofocus>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('زمان') }}</label>

                                <div class="col-md-6">
                                    <input id="time" type="time" class="form-control" name="time">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="clinic_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('انتخاب مطب') }}</label>

                                <div class="col-md-6">
                                    {{--                                    <input id="family" type="text"--}}
                                    {{--                                           class="form-control @error('family') is-invalid @enderror" name="family"--}}
                                    {{--                                           value="{{ old('family') }}" required autocomplete="family" autofocus>--}}
                                    <select name="clinic_id" id="clinic_id" class="form-control">
                                        @foreach($clinics as $clinic)
                                            @if(auth()->user()->id == $clinic->doctor_id)
                                                <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('clinic_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="status"
                                       class="col-md-4 col-form-label text-md-right">{{ __('وضعیت') }}</label>

                                <div class="col-md-6">
                                    {{--                                    <input id="family" type="text"--}}
                                    {{--                                           class="form-control @error('family') is-invalid @enderror" name="family"--}}
                                    {{--                                           value="{{ old('family') }}" required autocomplete="family" autofocus>--}}
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">رزرو</option>
                                        <option value="2">آزاد</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد ملی') }}</label>

                                <div class="col-md-6">
                                    <input id="doctor_id" type="text"
                                           class="form-control @error('doctor_id') is-invalid @enderror"
                                           name="doctor_id" value="{{$id}}" required
                                           autocomplete="doctor_id" autofocus readonly>

                                    @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">
                                        {{ __('ایجاد زمانبندی') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('لیست زمانبندی پزشک') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="address-box-color">
                            <tr>
                                <th>آیدی</th>
                                <th>مطب</th>
                                <th>تاریخ</th>
                                <th>ساعت</th>
                                <th>وضعیت</th>
                                {{--                                <th>کدملی</th>--}}
                                <th>مديريت</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach($times as $time)
                                @if($time->doctor_id  == $id)
                                    <tr>
                                        <td>{{$time->id}}</td>
                                        @foreach($clinics as $clinic)
                                            @if($time->clinic_id == $clinic->id)
                                                <td>{{$clinic->name}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$time->date}}</td>
                                        <td>{{$time->time}}</td>
                                        @switch($time->status)
                                            @case(1)
                                            @php
                                                $status= '<a href="" class="badge my-color text-white">رزرو</a>'
                                            @endphp
                                            @break

                                            @case(2)
                                            @php
                                                $status='<a href="" class="badge blue-color text-white" >آزاد</a>';
                                            @endphp
                                            @break
                                            @default
                                        @endswitch
                                        <td>{!! $status !!}</td>
                                        {{--                                        <td>{{$time->doctor_id}}</td>--}}


                                        <td>
                                            @if($time->status == 2)
                                                <a href="{{route('doctor.dashboard.scheduling.destroy',$time->id)}}"
                                                   onclick="return confirm('ايا مايل به حذف زمان تعیین شده هستید')">
                                                    <label class="badge red-color text-white">حذف</label>
                                                </a>
                                            @else
                                                <a href="#">
                                                    <label class="badge badge-secondary disabled" >حذف غیرفعال</label>
                                                </a>

                                            @endif
                                        </td>

                                    </tr>
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
