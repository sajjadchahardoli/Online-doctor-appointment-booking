
@extends('layouts.app')
@section('title')
    داشبورد - مدیریت منشی
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @foreach($doctors as $doctor)
                                    @if($doctor->id == $id)
                                        {{$doctor->name}} {{$doctor->family}}
                                    @endif
                                @endforeach
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('doctor.dashboard')}}">
                                    {{ __('داشبورد') }}
                                </a>
                                <a class="dropdown-item" href="{{route('doctor.dashboard.profile.edit',$id)}}">
                                    {{ __('ویرایش پروفایل') }}
                                </a>
                                <a class="dropdown-item" href="#">
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
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('ايجاد منشي') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('secretary.register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('کدملی') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                           name="id" value="{{old('id')}}" required autocomplete="id" autofocus >

                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('نام') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="family"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگی') }}</label>

                                <div class="col-md-6">
                                    <input id="family" type="text"
                                           class="form-control @error('family') is-invalid @enderror" name="family"
                                           value="{{ old('family') }}" required autocomplete="family" autofocus>

                                    @error('family')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                            @if($id == $clinic->doctor_id)
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
                                <label for="doctor_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد پزشک ') }}</label>

                                <div class="col-md-6">
                                    <input id="doctor_id" type="text"
                                           class="form-control @error('specialty') is-invalid @enderror"
                                           name="doctor_id" value="{{$id}}" required
                                           autocomplete="doctor_id" autofocus readonly>
                                    @error('doctor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('آدرس ایمیل') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">
                                        {{ __('ثبت نام') }}
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

        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('لیست منشی ها') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="address-box-color">
                            <tr>
                                <th>نام منشی</th>
                                <th>نام خانوادگی</th>
                                <th>نام مطب</th>
                                <th>مدیریت</th>
                            </tr>
                            </thead>

                            @foreach($secretaries as $secretary)
                                <tbody>
                                @if($secretary->doctor_id == $id)
                                    <td>{{$secretary->name}}</td>
                                    <td>{{$secretary->family}}</td>
                                    @foreach($clinics as $clinic)
                                        @if($secretary->clinic_id == $clinic->id)
                                    <td>{{$clinic->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <a href="{{route('doctor.dashboard.secretary.destroy',$secretary->id)}}" onclick="return confirm('ايا مايل به حذف منشی هستید. ')" class="badge red-color text-white">حذف</a>
                                        <a href="{{route('doctor.dashboard.secretary.profile',$secretary->id)}}" class="badge blue-color text-white">ویرایش</a>
                                    </td>
                                @endif
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
