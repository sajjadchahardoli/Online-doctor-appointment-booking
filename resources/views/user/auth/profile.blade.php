

@extends('layouts.app')
@section('title')
    داشبورد - ویرایش پروفایل
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
                                {{ Auth::user()->name }}
                                {{ Auth::user()->family }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{route('user.dashboard')}}">
                                    {{ __('داشبورد') }}
                                </a>

                                <a class="dropdown-item" href="{{route('profile',auth()->user()->id)}}">
                                    {{ __('ویرایش پروفایل') }}
                                </a>

                                <a class="dropdown-item" href="{{route('user.dashboard.insurance')}}">
                                    {{ __('ایجاد بیمه') }}
                                </a>

                                <a class="dropdown-item" href="{{route('user.dashboard.insurance.detail')}}#">
                                    {{ __('مشخصات بیمه') }}
                                </a>

                                <a class="dropdown-item" href="{{route('user.dashboard.reserve')}}">
                                    {{ __('نوبت های من') }}
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


    <!--Sign Up Form-->
    <div class="container">
        <section class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('ویرایش اطلاعات') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('update_profile',$user->id)}}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('نام') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control  @error('name') is-invalid @enderror" name="name"
                                           value="{{$user->name}}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="family"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادکی') }}</label>
                                <div class="col-md-6">
                                    <input id="family" type="text"
                                           class="form-control @error('family') is-invalid @enderror" name="family"
                                           value="{{$user->family }}" required autocomplete="family" autofocus>
                                    @error('family')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('کدملی') }}</label>
                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                           name="id" value="{{ $user->id }}" required autocomplete="id" autofocus
                                           readonly>
                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('ایمیل') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="ایمیل"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email }}" required autocomplete="email ">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('شماره تماس') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" placeholder="شماره تلفن"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ $user->phone}}" required autocomplete="phone">
                                    @error('phone')
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
                                            autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('تكرار رمز عبور') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">ويرايش پروفايل</button>
                                    <a type="button" class="btn red-color text-white" href="{{route('user.dashboard')}}">
                                        {{ __('انصراف') }}
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!--End Sign Up Form-->
@endsection

