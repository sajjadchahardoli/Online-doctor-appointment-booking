<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>داشبورد - ویرایش پروفایل</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{url('user/css/bootstrap-rtl.css')}}" rel="stylesheet">
    <link href="{{url('user/css/font-awesome.css')}}" rel="stylesheet">


</head>
<body class="rtl body-color">
<div id="app">
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
    <main >

        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-color text-white">{{ __('ویرایش اطلاعات') }}</div>

                        <div class="card-body">
                            @foreach($doctors as $doctor)
                                @if($doctor->id == $id)
                                    <form method="POST" action="{{ route('doctor.dashboard.profile.update',$doctor) }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('کدملی') }}</label>

                                            <div class="col-md-6">
                                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{$doctor->id}}" required autocomplete="id" autofocus readonly>

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
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$doctor->name}}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="family" class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگی') }}</label>

                                            <div class="col-md-6">
                                                <input id="family" type="text" class="form-control @error('family') is-invalid @enderror" name="family" value="{{$doctor->family}}" required autocomplete="family" autofocus>

                                                @error('family')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('جنسیت') }}</label>

                                            <div class="col-md-6">
                                                {{--                            <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>--}}
                                                <select class="form-control" name="gender" id="gender">
                                                    <option> مرد</option>
                                                    <option> زن</option>
                                                </select>
                                                @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="specialty" class="col-md-4 col-form-label text-md-right">{{ __('تخصص') }}</label>

                                            <div class="col-md-6">
                                                {{--                          <input id="specialty" type="text" class="form-control @error('specialty') is-invalid @enderror" name="specialty" value="{{ old('specialty') }}" required autocomplete="national_code" autofocus>--}}
                                                <select class="form-control" name="specialty" id="specialty">
                                                    <option>جراح و داندانپزشک</option>
                                                    <option>متخصص داندانپزشکی ترمیمی و زیبایی</option>
                                                    <option>متخصص درمان ریشه داندن</option>
                                                    <option>متخصص داندانپزشکی اطفال</option>
                                                    <option>متخصص پروتز های دندانی</option>
                                                    <option>متخصص تشخیص بیماری های دهان و دندان</option>
                                                </select>
                                                @error('specialty')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="medical_system_number" class="col-md-4 col-form-label text-md-right">{{ __('کد نظام پزشکی') }}</label>

                                            <div class="col-md-6">
                                                <input id="medical_system_number" type="text" class="form-control @error('medical_system_number') is-invalid @enderror" name="medical_system_number" value="{{$doctor->medical_system_number}}" required autocomplete="medical_system_number" autofocus>

                                                @error('medical_system_number')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('شماره تلفن') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$doctor->phone}}" required autocomplete="phone" autofocus>

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('آدرس ایمیل') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$doctor->email}}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('رمز عبور') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn card-header-color text-white">
                                                    {{ __('ثبت ویرایش') }}
                                                </button>
                                                <a class="btn red-color text-white" href="{{ route('doctor.dashboard') }}">{{ __('انصراف') }}</a>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>




