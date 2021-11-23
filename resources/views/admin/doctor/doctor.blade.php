@extends('admin.index')
@section('title')
    پنل مديريت - مديريت پرشکان
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">


            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('مدیریت پزشکان') }}</div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="address-box-color">
                                <tr>
                                    <th>نام</th>
                                    <th>نام خانوادگي</th>
                                    <th>جنسیت</th>
                                    <th>كدملي</th>
                                    <th>ايميل</th>
                                    <th>تلفن</th>
                                    <th>تخصص</th>
                                    <th>شماره نظام پزشکی</th>
                                    <th>وضعيت</th>
                                    <th>مديريت</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($doctors as $doctor)
                                    @switch($doctor->status)
                                        @case(1)
                                        @php
                                            $url=route('admin.doctor.status',$doctor->id);
                                            $status= '<a href="'.$url.'" class="badge badge-secondary text-black">غیر فعال</a>'
                                        @endphp
                                        @break

                                        @case(0)
                                        @php
                                            $url=route('admin.doctor.status',$doctor->id);
                                            $status='<a href="'.$url.'" class="badge my-color text-white">فعال</a>';
                                        @endphp
                                        @break
                                        @default
                                    @endswitch
                                    <tr>
                                        <td>{{$doctor->name}}</td>
                                        <td>{{$doctor->family}}</td>
                                        <td>{{$doctor->gender}}</td>
                                        <td>{{$doctor->id}}</td>
                                        <td>{{$doctor->email}}</td>
                                        <td>{{$doctor->phone}}</td>
                                        <td>{{$doctor->specialty}}</td>
                                        <td>{{$doctor->medical_system_number}}</td>
                                        <td>{!! $status !!}</td>
                                        <td>
                                            <a href="{{route('admin.doctor.delete',$doctor->id)}}"
                                               onclick="return confirm('ايا مايل به حذف كاربر هستيد')"><label
                                                    class="badge red-color text-white">حذف</label></a>
                                            <a href="{{route('admin.doctor.profile',$doctor->id)}}"><label
                                                    class="badge blue-color text-white">ويرايش</label></a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        @include('admin.footer')
    </div>
@endsection
