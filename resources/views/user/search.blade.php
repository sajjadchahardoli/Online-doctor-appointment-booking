<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>صفحه اصلی</title>
    {{--    <link rel="stylesheet" href="user/css/app.css">--}}
    <link rel="stylesheet" href="user/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="user/css/style.css">
    <link rel="stylesheet" href="user/css/bootstrap.min.css">
    <link rel="stylesheet" href="user/css/bootstrap-rtl.css">

</head>
<body class="rtl body-color">

<!--Navbar-->
@include('user.navbar')
<!--End Navbar-->

<!--Main Section-->

<!--Filter Section-->
{{--<section id="search-section container mb-5 ">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="text-center card-body">--}}
{{--                    <form>--}}
{{--                        <div class="form-row align-items-center text-center">--}}
{{--                            <div class="col-auto my-1 ">--}}
{{--                                <label>--}}
{{--                                    <select class=" custom-select mr-sm-2">--}}
{{--                                        <option selected>نوع مرکز درمانی ...</option>--}}
{{--                                        <option value="1">کلینیک</option>--}}
{{--                                        <option value="2">مطب</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-auto my-1">--}}
{{--                                <label>--}}
{{--                                    <select class="custom-select mr-sm-2">--}}
{{--                                        <option selected>تخصص</option>--}}
{{--                                        <option value="1">پزشک</option>--}}
{{--                                        <option value="2">دندانپزشک</option>--}}
{{--                                        <option value="3">روانپزشک</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-auto my-1">--}}
{{--                                <label>--}}
{{--                                    <select class="custom-select mr-sm-2">--}}
{{--                                        <option selected>حوزه کاری</option>--}}
{{--                                        <option value="1">پزشک</option>--}}
{{--                                        <option value="2">دندانپزشک</option>--}}
{{--                                        <option value="3">روانپزشک</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-auto my-1">--}}
{{--                                <label>--}}
{{--                                    <select class="custom-select mr-sm-2">--}}
{{--                                        <option selected>شهر</option>--}}
{{--                                        <option value="1">تهران</option>--}}
{{--                                        <option value="2">تبریز</option>--}}
{{--                                        <option value="3">مشهد</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-auto my-1">--}}
{{--                                <label>--}}
{{--                                    <select class="custom-select mr-sm-2">--}}
{{--                                        <option selected>جنسیت</option>--}}
{{--                                        <option value="1">زن</option>--}}
{{--                                        <option value="2">مرد</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="col-auto my-1">--}}
{{--                                <label>--}}
{{--                                    <select class="custom-select mr-sm-2">--}}
{{--                                        <option selected>بیمه</option>--}}
{{--                                        <option value="1">تامین اجتماعی</option>--}}
{{--                                        <option value="2">بسمه سلامت هممگانی</option>--}}
{{--                                    </select>--}}
{{--                                </label>--}}
{{--                            </div>--}}


{{--                        </div>--}}
{{--                    </form>--}}

{{--                    <div class="text-center">--}}
{{--                        <button class="btn btn-success"><i class="fa fa-search"></i>جستجو</button>--}}
{{--                    </div>--}}

{{--                    <p>یا نام متخصص را جسجو کنید</p>--}}

{{--                    <form class="form-row form-group">--}}
{{--                        <label>--}}
{{--                            <input type="search" class="input-group form-control" placeholder="جسجو">--}}
{{--                        </label>--}}
{{--                        <button class="btn btn-secondary"><i class="fa fa-search"></i></button>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}



{{--</section>--}}



<!--End Filter Section-->

<!--doctor page-->
@if($answers->isNotEmpty())
    @foreach($answers as $answer)
        {{--                این شرط برای نمایش پزشک است که در بخش مدیریت باید درست بشه--}}
        @if($answer->status==0)
            <section class="container mb-5 mt-5">

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-color text-white">{{$answer->specialty}}</div>

                            <div class="card-body">
                                <div class="container main-section">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 text-center">
                                            @if($answer->gender== 'زن')
                                                <a href="#">
                                                    <img src="user/images/young-female-doctor.jpg" alt=""
                                                         class="rounded"
                                                         width="150" height="162">
                                                </a>
                                            @else
                                                <a href="#">
                                                    <img src="user/images/young-male-doctor.jpg" alt="" class="rounded"
                                                         width="150" height="162">
                                                </a>
                                            @endif
                                            <p class="mt-3">{{$answer->name}} {{$answer->family}}</p>
                                            <a href="#" class="badge specialty-color p-2">{{$answer->specialty}}</a>
                                        </div>

                                        <div class="col-lg-10 col-md-9 mt-4">
                                            <div class="address-box-color h-50 rounded mt-lg-5 p-3">
                                                @foreach($clinics as $clinic)
                                                    @if($clinic->doctor_id == $answer->id)

                                                        <span>آدرس :</span>
                                                        <span>{{$clinic->address}}</span>
                                                        <br class="mt-1">

                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="float-left mt-5">
                                                <a href="{{route('doctor',$answer->id)}}"
                                                   class="btn  text-white button-color">مشاهده اطلاعات بیشتر</a>
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
@else
    <div class="alert red-color text-white mt-5 mb-5 container">
        پزشک مورد نظر یافت نشد !
    </div>
@endif
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

<!-- Footer -->

<script src="user/js/jquery.min.3.3.1.js"></script>
<script src="user/js/bootstrap.min.js"></script>
<script src="user/js/script.js"></script>
</body>
</html>
