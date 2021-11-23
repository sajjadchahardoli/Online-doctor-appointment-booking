<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="user/css/sign-in-up.css">
    <link rel="stylesheet" href="user/css/style.css">
    <link rel="stylesheet" href="user/fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="user/css/bootstrap.min.css">
    <link rel="stylesheet" href="user/css/bootstrap-rtl.css">

</head>
<body class="rtl">
<!--Navbar-->
@include('user.navbar')
<!--End Navbar-->

<!--Sign Up Form-->
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">ثبت نام</h2>
                    <form method="POST" action="{{route('register')}}" class="register-form" id="register-form">
                        @csrf


                        <div class="form-group">
                            <label for="name"><i class="far fa-user"></i></label>
                                <input id="name" type="text" placeholder="نام" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="family"><i class="far fa-user"></i></label>
                            <input id="family" type="text" placeholder="نام خانوادگی" class=" @error('family') is-invalid @enderror" name="family" value="{{ old('family') }}" required autocomplete="family" autofocus>
                            @error('family')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="national_code"><i class="far fa-user"></i></label>
                            <input id="national_code" type="text" placeholder="کدملی" class=" @error('national_code') is-invalid @enderror" name="national_code" value="{{ old('national_code') }}" required autocomplete="national_code" autofocus>
                            @error('national_code')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>




                        <div class="form-group">
                            <label for="email" ><i class="far fa-user"></i></label>
                                <input id="email" type="email" placeholder="ایمیل" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email ">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" ><i class="far fa-user"></i></label>
                                <input id="phone" type="text" placeholder="شماره تلفن" class=" @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>



                        <div class="form-group">
                            <label for="password" ><i class="far fa-lock-alt"></i></label>
                                <input id="password" type="password" placeholder="رمز عبور" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm"><i class="far fa-lock-alt"></i></label>
                                <input id="password-confirm" type="password" placeholder="تکرار رمز عبور" name="password_confirmation" required autocomplete="new-password">
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />--}}
{{--                            <label for="agree-term" class="label-agree-term"><span><span></span></span> با تمام ضوابط و شرایط موافقم <a href="#" class="term-service">شرایط استفاده از خدمات</a></label>--}}
{{--                        </div>--}}
                        <div class="form-group form-button">
                            <button type="submit" class="btn btn-primary">ثبت نام</button>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="user/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">من قبلا عضو هستم</a>
                </div>
            </div>
        </div>
    </section></div>

<!--End Sign Up Form-->


<!-- Footer -->
<footer>
    <div class="container-fluid" id="footer">
        <div class="text-center ">
            <i class="far fa-copyright "> </i>
            تمامی حقوق این وب‌سایت محفوظ است و انتشار مطالب آن با ذکر منبع بلامانع می‌باشد.
        </div>
    </div>

</footer>
<!-- Footer -->

<script src="user/js/jquery.min.3.3.1.js"></script>
<script src="user/js/bootstrap.min.js"></script>
<script src="user/js/script.js"></script>

</body>
</html>
