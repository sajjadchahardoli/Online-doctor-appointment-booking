@extends('layouts.app')
@section('title')
    داشبورد - مشخصات بیمه
@endsection
@section('content')

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="text-secondary" style="text-decoration: none" href="{{ url('/') }}">
                صفحه اصلی
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                    <div class="card-header card-header-color text-white">{{ __('مشخصات بیمه کاربر') }}</div>
                    <div class="card-body">
                        @php
                            $counter=0;
                        @endphp
                        @foreach($insurances as $insurance)
                            @foreach($details as $detail)
                                @if($insurance->id == $detail->insurance_id)
                                    @php
                                        ++$counter
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach
                        @if($counter==0)
                            <form method="POST" action="{{route('user.dashboard.insurance.detail.store')}}">
                                @csrf
                                <div class="form-group row">
                                    @foreach($insurances as $insurance)
                                        @if($insurance->user_id == auth()->user()->id)
                                            <label for="insurance_id"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('کد بيمه') }}</label>
                                            <div class="col-md-6">
                                                <input id="insurance_id" type="text"
                                                       class="form-control @error('insurance_id') is-invalid @enderror"
                                                       name="insurance_id" value="{{ $insurance->id }}" required
                                                       autocomplete="insurance_id" autofocus readonly="readonly">

                                                @error('id')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('نام بيمه شونده') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class=" form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{old('name')}}" required autocomplete="name"
                                               autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="family"
                                           class="col-md-4 col-form-label text-md-right">{{ __('نام خانوادگي بيمه شونده') }}</label>

                                    <div class="col-md-6">
                                        <input id="family" type="text"
                                               class=" form-control @error('family') is-invalid @enderror"
                                               name="family" value="{{old('family')}}" required autocomplete="family"
                                               autofocus>

                                        @error('family')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date"
                                           class="col-md-4 col-form-label text-md-right">{{ __('تاريخ اعتبار') }}</label>

                                    <div class="col-md-6">
                                        <input id="date" type="date"
                                               class=" form-control @error('date') is-invalid @enderror"
                                               name="date" value="{{old('date')}}" required autocomplete="date"
                                               autofocus>

                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn card-header-color text-white">
                                            {{ __('ثبت مشخصات بيمه') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <p class="alert alert-danger"> اضافه كردن مشخصات بيمه امکان پذیر نیست.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header card-header-color text-white">{{ __('مشخصات بیمه ') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="address-box-color">
                            <tr>
                                <th>كد بيمه</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>تاریخ</th>
                                <th>مديريت</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($insurances as $insurance)
                                @foreach($details as $detail)
                                    @if($insurance->id == $detail->insurance_id)
                                        <tr>
                                            <td>{{$detail->insurance_id}}</td>
                                            <td>{{$detail->name}}</td>
                                            <td>{{$detail->family}}</td>
                                            <td>{{$detail->date}}</td>
                                            <td>
                                                <a href="{{route('user.dashboard.insurance.detail.destroy',$detail->id)}}"
                                                   onclick="return confirm('ايا مايل به حذف مشخصات بیمه هستید.')">
                                                    <label class="badge red-color text-white">حذف</label>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>


    </div>
@endsection