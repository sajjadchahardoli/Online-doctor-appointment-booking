@extends('admin.index')
@section('title')
ویرایش دسته بندی
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title"> ویرایش دسته بندی</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.categories.update',$category->id)}}"
                                  class="register-form" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name"><i class="far fa-user"></i></label>
                                    <input id="name" type="text" placeholder="نام دسته بندی"
                                           class=" @error('name') is-invalid @enderror" name="name"
                                           value="{{$category->name}}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug"><i class="far fa-user"></i></label>
                                    <input id="slug" type="text" placeholder="نام مستعار"
                                           class=" @error('slug') is-invalid @enderror" name="slug"
                                           value="{{$category->slug}}" required autocomplete="slug" autofocus>
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group form-button">
                                    <button type="submit" class="btn btn-primary">ویرایش</button>
                                    <a href="{{route('admin.categories')}}" class="btn btn-warning">انصراف</a>
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
