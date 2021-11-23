

@extends('layouts.app')
@section('title')
    داشبورد - ایجاد بیمه
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

                                <a class="dropdown-item" href="{{route('user.dashboard.insurance.detail')}}">
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


    <div class="container ">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('ایجاد بیمه') }}</div>
                    <div class="card-body">
                        @php
                            $counter=0;
                        @endphp
                        @foreach($insurances as $insurance)
                            @if($insurance->user_id == auth()->user()->id)
                                @php
                                    ++$counter
                                @endphp
                            @endif
                        @endforeach
                        @if($counter==0)
                        <form method="POST" action="{{route('user.dashboard.insurance.store')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد بيمه') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                           name="id" value="{{ old('id') }}" required autocomplete="id" autofocus>

                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type"
                                       class="col-md-4 col-form-label text-md-right">{{ __('نوع بيمه') }}</label>

                                <div class="col-md-6">
                                        <select name="type" id="type" class="form-control">
                                            <option value="بيمه سلامت همگاني">بيمه سلامت همگاني</option>
                                            <option value="بيمه درمان تامين اجتماعي">بيمه درمان تامين اجتماعي</option>
                                            <option value="بيمه سلامت عشاير و روستاييان">بيمه سلامت عشاير و روستاييان</option>
                                            <option value="بيمه خدمات درماني نيرو هاي مسلح">بيمه خدمات درماني نيرو هاي مسلح</option>
                                        </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('کد ملي') }}</label>

                                <div class="col-md-6">
                                    <input  id="user_id" type="text" class=" form-control @error('user_id') is-invalid @enderror"
                                           name="user_id" value="{{auth()->user()->id}}" required autocomplete="user_id" autofocus readonly="readonly">

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn card-header-color text-white">
                                        {{ __('ایجاد بيمه') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                            @else
                            <p class="alert alert-danger"> اضافه كردن بيمه جديد امکان پذیر نیست.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('بیمه کاربر') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="address-box-color">
                            <tr>
                                <th>كد بيمه</th>
                                <th>نوع بيمه</th>
                                <th>کدملی</th>
                                <th>مديريت</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($insurances as $insurance)
                                @if($insurance->user_id == auth()->user()->id)
                                    <tr>
                                        <td>{{$insurance->id}}</td>
                                        <td>{{$insurance->type}}</td>
                                        <td>{{$insurance->user_id}}</td>
                                        <td>
                                            <a href="{{route('user.dashboard.insurance.destroy',$insurance->id)}}"
                                               onclick="return confirm('ايا مايل به حذف اطلاعات بیمه هستید.')">
                                                <label class="badge red-color text-white">حذف</label>
                                            </a>
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
