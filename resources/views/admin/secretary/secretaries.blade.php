@extends('admin.index')
@section('title')
    پنل مديريت - مديريت منشی‌ها
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('مدیریت منشی‌ها') }}</div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="address-box-color" >
                                <tr>
                                    <th>كدملي</th>
                                    <th>نام</th>
                                    <th>نام خانوادگي</th>
                                    <th>شناسه پزشک</th>
                                    <th>شناسه مطب</th>
                                    <th>ايميل</th>
                                    <th>مديريت</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($secretaries as $secretary)
                                    <tr>
                                        <td>{{$secretary->id}}</td>
                                        <td>{{$secretary->name}}</td>
                                        <td>{{$secretary->family}}</td>
                                        <td>{{$secretary->doctor_id}}</td>
                                        <td>{{$secretary->clinic_id}}</td>
                                        <td>{{$secretary->email}}</td>

                                        <td>
                                            <a  href="{{route('admin.secretary.delete',$secretary->id)}}"
                                               onclick="return confirm('ايا مايل به حذف كاربر هستيد')"><label
                                                    class="badge red-color text-white ">حذف</label></a>
                                            <a href="{{route('admin.secretary.profile',$secretary->id)}}"><label
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
