<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>صفحه پزشک</title>
    {{--    <link rel="stylesheet" href="user/css/app.css">--}}
    <link rel="stylesheet" href="{{url('user/fonts/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{url('user/css/style.css')}}">
    <link rel="stylesheet" href="{{url('user/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('user/css/bootstrap-rtl.css')}}">

</head>
<body class="rtl body-color">

<!--Navbar-->
@include('user.navbar')
<!--End Navbar-->

<!--Main Section-->

<!--Filter Section-->

<!--End Filter Section-->

<!--doctor page-->

@foreach($doctors as $doctor)
    @if($id == $doctor->id)
        <section class="container mb-5 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-color text-white">{{$doctor->specialty}}</div>
                        <div class="card-body">
                            <div class="container main-section">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 text-center">

                                        @if($doctor->gender== 'زن')
                                            <a href="#">
                                                <img src="{{url('user/images/young-female-doctor.jpg')}}" alt=""
                                                     class="rounded" width="150" height="162">
                                            </a>
                                        @else
                                            <a href="#">
                                                <img src="{{url('user/images/young-male-doctor.jpg')}}" alt=""
                                                     class="rounded" width="150" height="162">
                                            </a>
                                        @endif
                                        <p class="mt-3">{{$doctor->name}} {{$doctor->family}}</p>
                                        <a href="#" class="badge specialty-color">{{$doctor->specialty}}</a>
                                    </div>

                                    <div class="col-lg-10 col-md-9">
                                        <div class="address-box-color h-50 rounded mt-lg-5 p-3">
                                            @foreach($clinics as $clinic)
                                                @if($clinic->doctor_id == $doctor->id)
                                                    <span>آدرس {{$clinic->name}} :</span>
                                                    <span>{{$clinic->address}}</span>
                                                    <br class="mt-1">
                                                @endif
                                            @endforeach

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endforeach


<div class="row justify-content-center mt-4 mb-5">
    <div class="container grid-margin stretch-card">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header text-white card-header-color">{{ __(' رزرو وقت حضوری') }}</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="address-box-color">
                        <tr>
                            <td>نام مطب</td>
                            <th>تاریخ</th>
                            <th>ساعت</th>
                            {{--                            <th>وضعیت</th>--}}
                            <th>رزرو نوبت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @php
                            $counter=0;
                        @endphp
                        @foreach($times as $time)
                            @if($time->doctor_id  == $id && $time->status == 2)
                                <tr>
                                    @foreach($clinics as $clinic)
                                        @if($time->clinic_id == $clinic->id)
                                            <td>{{$clinic->name}}</td>
                                        @endif
                                    @endforeach
                                    <td>{{$time->date}}</td>
                                    <td>{{$time->time}}</td>
                                    @switch($time->status)
                                        @case(1)
                                        @php
                                            $status= '<a href="" class="badge badge-primary">رزرو</a>'
                                        @endphp
                                        @break

                                        @case(2)
                                        @php
                                            $status='<a href="" class="color-black" style="color:black;">آزاد</a>';
                                        @endphp
                                        @break
                                        @default
                                    @endswitch
                                    {{--                                    <td>{!! $status !!}</td>--}}


                                    @guest
                                        <td>
                                            @if($time->status == 2)
                                                @php

                                                    $status='<a href="#" class="btn button-color text-white btn-sm">عدم دسترسی</a>';
                                                @endphp
                                                {!! $status !!}
                                            @endif
                                        </td>
                                    @else
                                        @if(auth()->user()->status == 1)
                                            <td>
                                                @if($time->status == 2)
                                                    @php
                                                        $url=route('doctor.status',$time->id);
                                                        $status='<a href="'.$url.'" class="btn button-color text-white btn-sm">رزرو نوبت</a>';
                                                    @endphp
                                                    {!! $status !!}
                                                @endif
                                            </td>
                                        @elseif(auth()->user()->status == 0)
                                            <td>
                                                @if($time->status == 2)
                                                    @php

                                                        $status='<a href="#" class="btn button-color text-white btn-sm">عدم دسترسی</a>';
                                                    @endphp
                                                    {!! $status !!}
                                                @endif
                                            </td>
                                        @endif
                                    @endguest

                                    {{--                                    @if(auth()->user()->status == 1)--}}
                                    {{--                                        <td>--}}
                                    {{--                                            @if($time->status == 2)--}}
                                    {{--                                                @php--}}
                                    {{--                                                    $url=route('doctor.status',$time->id);--}}
                                    {{--                                                    $status='<a href="'.$url.'" class="btn button-color text-white btn-sm">رزرو نوبت</a>';--}}
                                    {{--                                                @endphp--}}
                                    {{--                                                {!! $status !!}--}}
                                    {{--                                            @endif--}}
                                    {{--                                        </td>--}}
                                    {{--                                    @elseif(auth()->user()->status == 0)--}}
                                    {{--                                            <td>--}}
                                    {{--                                                @if($time->status == 2)--}}
                                    {{--                                                    @php--}}

                                    {{--                                                        $status='<a href="#" class="btn button-color text-white btn-sm">عدم دسترسی</a>';--}}
                                    {{--                                                    @endphp--}}
                                    {{--                                                    {!! $status !!}--}}
                                    {{--                                                @endif--}}
                                    {{--                                            </td>--}}
                                    {{--                                    @endif--}}

                                </tr>
                                @php
                                    $counter=1;
                                @endphp
                            @endif

                        @endforeach

                        </tbody>

                    </table>
                    @if($counter == 0)
                        <a class="alert alert-danger row m-5">{{__('نویت خالی وجود ندارد')}}</a>

                    @endif
                </div>

            </div>
        </div>

    </div>
</div>


<!--End doctor page-->

<!-- End Main Section-->

<!--pagination-->
{{--<nav aria-label="Page navigation example">--}}
{{--    <ul class="pagination justify-content-center">--}}
{{--        <li class="page-item disabled">--}}
{{--            <a class="page-link" href="#" tabindex="-1">Previous</a>--}}
{{--        </li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--        <li class="page-item">--}}
{{--            <a class="page-link" href="#">Next</a>--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</nav>--}}
<!--End pagination-->


<!-- Footer -->
<footer>
    <div class="container-fluid bg-white text-secondary p-3" id="">
        <div class="text-center ">
            <i class="far fa-copyright "> </i>
            تمامی حقوق این وب‌سایت محفوظ است و انتشار مطالب آن با ذکر منبع بلامانع می‌باشد.
        </div>
    </div>

</footer>
<!-- Footer -->

<script src="{{url('user/js/jquery.min.3.3.1.js')}}"></script>
<script src="{{url('user/js/bootstrap.min.js')}}"></script>
<script src="{{url('user/js/script.js')}}"></script>
</body>
</html>
