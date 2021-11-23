@extends('admin.index')
@section('title')
    مطلب جدید
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title"> مطلب جدید</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.article.store')}}"
                                  class="register-form" id="register-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name"><i class="far fa-user"></i></label>
                                    <input id="name" type="text" placeholder="نام مطلب"
                                           class=" @error('name') is-invalid @enderror" name="name"
                                           value="{{old('name')}}" required autocomplete="name" autofocus>
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
                                           value="{{old('slug')}}" required autocomplete="slug" autofocus>
                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description"><i class="far fa-user"></i></label>
                                    <textarea id="description" type="text" placeholder="محتوای مطلب "
                                              class=" @error('description') is-invalid @enderror"
                                              name="description">{{old('description')}}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="user_id"><i class="far fa-user"></i>نویسنده: {{Auth::user()->name}}
                                    </label>
                                    <input type="hidden" placeholder="نویسنده:" name="user_id"
                                           value="{{Auth::user()->id}}">
                                </div>

                                <div class="form-group">
                                    <label for="status"><i class="far fa-user"></i>وضعیت</label>
                                    <select name="status" class="form-control">
                                        <option value="0">منتشر نشده</option>
                                        <option value="1">منتشر شده</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category"><i class="far fa-user"></i>دسته بندی</label>
                                    <select name="category" class="form-control" multiple>
                                        <option value="1">اخبار ورزشی</option>
                                        <option value="2">اخبار تکنولوژی</option>
                                        <option value="3">اخبار مذهبی</option>
                                    </select>
                                </div>





                                <div class="form-group form-button">
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                    <a href="{{route('admin.article')}}" class="btn btn-warning">انصراف</a>
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
