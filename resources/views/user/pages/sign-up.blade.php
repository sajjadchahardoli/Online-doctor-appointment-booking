<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-rtl.css">
</head>
<body class="rtl">
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-mainbg">
    <!--    <a class="navbar-brand navbar-logo" href="#">Navbar</a>-->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white" id="bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <div class="hori-selector">
                <div class="left"></div>
                <div class="right"></div>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0);"><i class="far fa-home-lg-alt"></i>صفحه اصلی</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="javascript:void(0);"><i class="fa fa-search"></i>جستجو</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0);"><i class="far fa-map"></i>راهنما و سوالات متداول</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0);"><i class="far fa-user"></i>همکاری متخصصان</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0);"><i class="far fa-users"></i>درباره ما</a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="javascript:void(0);"><i class="fal fa-mail-bulk"></i>تماس با ما</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-sign-in"></i>ثبت نام | راهیابی
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" style="color: black !important;" href="#">ثبت نام</a>
                    <a class="dropdown-item" style="color: black !important;" href="#">راهیابی</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--End Navbar-->

<!--Sign Up Form-->
<div class="main">
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">ثبت نام</h2>
                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="far fa-user"></i></label>
                            <input type="text" name="name" id="name" placeholder="نام"/>
                        </div>
                        <div class="form-group">
                            <label for="family"><i class="far fa-user"></i></label>
                            <input type="text" name="family" id="family" placeholder="نام خانوادگی"/>
                        </div>
                        <div class="form-group">
                            <label for="national-code"><i class="far fa-user"></i></label>
                            <input type="text" name="family" id="national-code" placeholder="کدملی"/>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="far fa-user"></i></label>
                            <input type="text" name="phone" id="phone" placeholder="تلفن"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="far fa-user"></i></label>
                            <input type="email" name="email" id="email" placeholder="ایمیل"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="far fa-lock-alt"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="رمز عبور"/>
                        </div>
                        <div class="form-group">
                            <label for="re_pass"><i class="far fa-lock-alt"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="تکرار رمز عبور"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span> با تمام ضوابط و شرایط موافقم <a href="#" class="term-service">شرایط استفاده از خدمات</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="ثبت نام"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="../images/signup-image.jpg" alt="sing up image"></figure>
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

<script src="../js/jquery.min.3.3.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
