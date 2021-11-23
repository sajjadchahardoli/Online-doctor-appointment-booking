

@extends('layouts.app')
@section('title')
    داشبورد - ویرایش مطب
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

    <div class="container ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('ویرایش مطب') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('doctor.dashboard.clinic.update',$clinic->id)}}">
                            @csrf
                            <div class="form-group row">
                                <label for="id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد مطب') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                           name="id" value="{{ $clinic->id }}" required autocomplete="id" autofocus readonly="readonly">

                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نام مطب') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ $clinic->name }}" required autocomplete="name" autofocus>

                                    @error('name')
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
                                    <input id="doctor_id" type="text" class="form-control @error('doctor_id') is-invalid @enderror"
                                           name="doctor_id" value="{{$clinic->doctor_id }}" required autocomplete="doctor_id" autofocus readonly>

                                    @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="code"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد مرکز درمانی') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror"
                                           name="code" value="{{ $clinic->code }}" required autocomplete="code" autofocus>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="type"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نوع مرکز درمانی') }}</label>

                                <div class="col-md-6">
{{--                                    <input id="family" type="text"--}}
{{--                                           class="form-control @error('family') is-invalid @enderror" name="family"--}}
{{--                                           value="{{ old('family') }}" required autocomplete="family" autofocus>--}}
                                        <select name="type" id="type" class="form-control">
                                            <option value="1">مطب</option>
                                            <option value="2">کلینیک</option>
                                        </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('شماره تماس مرکز') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ $clinic->phone }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-4 col-form-label text-md-right">{{ __('آدرس مرکز') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                           name="address" value="{{ $clinic->address }}" required autocomplete="address" autofocus>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">
                                        {{ __('ویرایش مطب') }}
                                    </button>
                                    <a class="btn red-color text-white"
                                       href="{{ route('doctor.dashboard') }}">{{ __('انصراف') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
