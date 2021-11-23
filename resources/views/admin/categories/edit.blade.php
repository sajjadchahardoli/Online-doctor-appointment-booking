@extends('admin.index')
@section('title')
    پنل مديريت - ویرایش تخصص‌
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('ویرایش تخصص‌') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.categories.update',$category->id)}}"
                                  class="register-form" id="register-form">
                                @csrf
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('نام تخصص') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{$category->name}}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug"
                                           class="col-md-4 col-form-label text-md-right">{{ __('نام مستعار') }}</label>
                                    <div class="col-md-6">
                                        <input id="slug" type="text" placeholder="نام مستعار"
                                               class="form-control @error('slug') is-invalid @enderror" name="slug"
                                               value="{{$category->slug}}" required autocomplete="slug" autofocus>
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn card-header-color text-white">ویرایش</button>
                                        <a href="{{route('admin.categories')}}" class="btn red-color text-white">انصراف</a>
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
