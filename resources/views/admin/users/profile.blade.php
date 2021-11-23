@extends('admin.index')
@section('title')
    پنل مديريت - ویرایش كاربران
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('ویرایش کاربران') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.update_profile',$user->id)}}"
                                  class="register-form" id="register-form">
                                @csrf
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('نام') }}</label>

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
                                    <label for="id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('کدملی') }}</label>
                                    <div class="col-md-6">
                                        <input id="id" type="text"
                                               class="form-control @error('id') is-invalid @enderror"
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
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
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
                                           class="col-md-4 col-form-label text-md-right">{{ __('تکرار رمز عبور') }}</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password_confirmation"  autocomplete="new-password">
                                    </div>
                                </div>

                                {{--                        <div class="form-group">--}}
                                {{--                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />--}}
                                {{--                            <label for="agree-term" class="label-agree-term"><span><span></span></span> با تمام ضوابط و شرایط موافقم <a href="#" class="term-service">شرایط استفاده از خدمات</a></label>--}}
                                {{--                        </div>--}}
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn card-header-color text-white">ويرايش پروفايل</button>
                                        <a href="{{route('admin.users')}}" class="btn red-color text-white">انصراف</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
    </div>
@endsection
