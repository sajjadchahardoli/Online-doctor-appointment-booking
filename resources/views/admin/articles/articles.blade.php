@extends('admin.index')
@section('title')
    پنل مدیریت - مديريت مطالب
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row page-title-header">
                <div class="col-12">
                    <div class="page-header">
                        <h4 class="page-title">مديريت مطالب</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="{{route('admin.article.create')}}" class="btn btn-success">
                    ایجاد مطلب جدید
                </a>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>نام مستعار</th>
                                    <th>توضیحات</th>
                                    <th>نویسنده</th>
                                    <th>دسته بندی</th>
                                    <th>بازدید</th>
                                    <th>وضعیت</th>
                                    <th>مدیریت</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->name}}</td>
                                        <td>{{$article->slug}}</td>
                                        <td>{{$article->description}}</td>
                                        <td>{{$article->user_id}}</td>
                                        <td>--</td>
                                        <td>{{$article->hit}}</td>
                                        <td>{{$article->status}}</td>
                                        <td>
                                            <a href="{{route('admin.article.destroy',$article->id)}}"
                                               onclick="return confirm('ايا مايل به حذف كاربر هستيد')"><label
                                                    class="badge badge-danger">حذف</label></a>
                                            <a href="{{route('admin.article.edit',$article->id)}}"><label
                                                    class="badge badge-success">ويرايش</label></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                {{$articles->links()}}
            </div>

        </div>
        @include('admin.footer')
    </div>
@endsection
