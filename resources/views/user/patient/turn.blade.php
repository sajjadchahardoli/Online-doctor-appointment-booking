

@extends('layouts.app')
@section('title')
    تایید نوبت
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
                            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                ثبت نام | راهیابی
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-secondary" href="{{route('register')}}">
                                    ثبت نام
                                </a>

                                <a class="dropdown-item text-secondary" href="{{route('login')}}">
                                    راهیابی
                                </a>

                                <a class="dropdown-item text-secondary" href="{{route('doctor.register')}}">
                                    ثبت نام پزشک
                                </a>

                                <a class="dropdown-item text-secondary" href="{{route('doctor.login')}}">
                                    راهیابی پزشک
                                </a>

                            </div>
                        </li>

                        {{--                    @if (Route::has('login'))--}}
                        {{--                        <li class="nav-item ">--}}
                        {{--                            <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('ورود') }}</a>--}}
                        {{--                        </li>--}}
                        {{--                    @endif--}}

                        {{--                    @if (Route::has('register'))--}}
                        {{--                        <li class="nav-item ">--}}
                        {{--                            <a class="nav-link text-secondary" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>--}}
                        {{--                        </li>--}}
                        {{--                    @endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                {{ Auth::user()->family }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->role==1)
                                    <a href="{{route('admin')}}" class="text-secondary" target="_blank">
                                        پنل مدیریت
                                    </a>
                                @endif

                                <a href="{{route('user.dashboard')}}" class="text-secondary">داشبورد</a>

                                <a class="dropdown-item text-secondary" href="{{ route('logout') }}"
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
                    <div class="card-header card-header-color text-white">{{ __('تایید نوبت ') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('user.turn.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="user_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('شناسه کاربر') }}</label>

                                <div class="col-md-6">
                                    <input id="user_id" type="text"
                                           class="form-control @error('user_id') is-invalid @enderror"
                                           name="user_id" value="{{auth()->user()->id}}" required
                                           autocomplete="user_id" autofocus readonly="readonly">

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @foreach($times as $time)
                                @if($time->id == $id)
                                    @php
                                        $doctor_id=$time->doctor_id
                                    @endphp
                                    @foreach($doctors as $doctor)
                                        @if($doctor->id == $doctor_id)
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('نام پزشک') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           name="name" value="{{$doctor->name}}" required
                                                           autocomplete="name" autofocus readonly="readonly">

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="family"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگی پزشک') }}</label>

                                                <div class="col-md-6">
                                                    <input id="family" type="text"
                                                           class="form-control @error('family') is-invalid @enderror"
                                                           name="family" value="{{$doctor->family}}" required
                                                           autocomplete="family"
                                                           autofocus readonly="readonly">

                                                    @error('family')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="specialty"
                                                       class="col-md-4 col-form-label text-md-right">{{ __('تخصص پزشک') }}</label>

                                                <div class="col-md-6">
                                                    <input id="specialty" type="text"
                                                           class="form-control @error('specialty') is-invalid @enderror"
                                                           name="specialty" value="{{$doctor->specialty}}" required
                                                           autocomplete="specialty" autofocus readonly="readonly">

                                                    @error('specialty')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="form-group row">
                                        <label for="date"
                                               class="col-md-4 col-form-label text-md-right">{{ __('تاریخ ویزیت') }}</label>

                                        <div class="col-md-6">
                                            <input id="date" type="date"
                                                   class="form-control @error('date') is-invalid @enderror"
                                                   name="date" value="{{$time->date}}" required autocomplete="date"
                                                   autofocus readonly="readonly">

                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="time"
                                               class="col-md-4 col-form-label text-md-right">{{ __('زمان ویزیت') }}</label>

                                        <div class="col-md-6">
                                            <input id="time" type="time"
                                                   class="form-control @error('time') is-invalid @enderror"
                                                   name="time" value="{{$time->time}}" required autocomplete="time"
                                                   autofocus readonly="readonly">

                                            @error('time')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    @foreach($clinics as $clinic)
                                        @if($time->clinic_id == $clinic->id)
                                        <div class="form-group row">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('شماره تلفن') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text"
                                                       class=" form-control @error('phone') is-invalid @enderror"
                                                       name="phone" value="{{$clinic->phone}}" required autocomplete="phone" autofocus readonly="readonly">

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('آدرس') }}</label>

                                            <div class="col-md-6">
                                                <input id="address" type="text"
                                                       class=" form-control @error('address') is-invalid @enderror"
                                                       name="address" value="{{$clinic->address}}" required autocomplete="address"
                                                       autofocus readonly="readonly">

                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">
                                        {{ __('تایید نوبت') }}
                                    </button>
                                    <a type="button" class="btn red-color text-white" href="{{route('doctor.status',$time->id)}}">
                                        {{ __('لغو نوبت') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
