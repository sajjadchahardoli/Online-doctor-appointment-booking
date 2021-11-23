@extends('admin.index')
@section('title')
    پنل مدیریت - مدبریت تخصص ها
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('مدیریت تخصص‌ها') }}</div>

                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="address-box-color">
                                <tr>
                                    <th>نام</th>
                                    <th>نام مستعار</th>
                                    <th>مديريت</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->slug}}</td>
                                        <td>
                                            <a href="{{route('admin.categories.destroy',$category->id)}}"
                                               onclick="return confirm('ايا مايل به حذف كاربر هستيد')"><label
                                                    class="badge red-color text-white">حذف</label></a>
                                            <a href="{{route('admin.categories.edit',$category->id)}}"><label
                                                    class="badge blue-color text-white">ويرايش</label></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{route('admin.categories.create')}}" class="btn btn-sm card-header-color text-white mt-5">
                                ایجاد تخصص جدید
                            </a>
                        </div>

                    </div>

                </div>
                {{$categories->links()}}
            </div>

        </div>
        @include('admin.footer')
    </div>
@endsection
