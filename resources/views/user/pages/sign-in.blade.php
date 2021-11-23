<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-rtl.css">
</head>
<body class="rtl">
<!--Navbar-->
@include('user.navbar')
<!--End Navbar-->

<!--Login Form-->
<div class="main">
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">ایجاد اکانت کاربری</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">ورود</h2>
                    <form method="POST" class="register-form" id="login-form">
                        <div class="form-group">
                            <label for="your_name"><i class="far fa-user"></i></label>
                            <input type="text" name="your_name" id="your_name" placeholder="کدملی"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="far fa-lock-alt"></i></label>
                            <input type="password" name="your_pass" id="your_pass" placeholder="رمز ورود"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"/>
                            <label for="remember-me" class="label-agree-term"><span><span></span></span> مرا به خاطر
                                بسپار </label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="ورود"/>
                        </div>
                    </form>
                    <!--                <div class="social-login">-->
                    <!--                    <span class="social-label">Or login with</span>-->
                    <!--                    <ul class="socials">-->
                    <!--                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>-->
                    <!--                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>-->
                    <!--                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>-->
                    <!--                    </ul>-->
                    <!--                </div>-->
                </div>
            </div>
        </div>
    </section>
</div>

<!--End Longin Form-->


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
