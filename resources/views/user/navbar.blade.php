{{--<nav class="navbar navbar-expand-lg navbar-mainbg">--}}
{{--    <!--    <a class="navbar-brand navbar-logo" href="#">Navbar</a>-->--}}
{{--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"--}}
{{--            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--        <i class="fas fa-bars text-white" id="bars"></i>--}}
{{--    </button>--}}

{{--    <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--        <ul class="navbar-nav mr-auto">--}}
{{--            <div class="hori-selector">--}}
{{--                <div class="left"></div>--}}
{{--                <div class="right"></div>--}}
{{--            </div>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('main')}}"><i class="far fa-home-lg-alt"></i>صفحه اصلی</a>--}}
{{--            </li>--}}
{{--            <li class="nav-item active">--}}
{{--                <a class="nav-link" href="javascript:void(0);"><i class="fa fa-search"></i>جستجو</a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="javascript:void(0);"><i class="far fa-map"></i>راهنما و سوالات متداول</a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="javascript:void(0);"><i class="far fa-user"></i>همکاری متخصصان</a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="javascript:void(0);"><i class="far fa-users"></i>درباره ما</a>--}}
{{--            </li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link " href="javascript:void(0);"><i class="fal fa-mail-bulk"></i>تماس با ما</a>--}}
{{--            </li>--}}

{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"--}}
{{--                   aria-haspopup="true" aria-expanded="false">--}}
{{--                    <i class="far fa-sign-in"></i>ثبت نام | راهیابی--}}
{{--                </a>--}}
{{--                <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}

{{--                    @auth--}}
{{--                        وقتی که لاگین هستیم--}}
{{--                        @if(auth()->user()->role==1)--}}
{{--                            <a href="{{route('admin')}}"  style="color: black !important;" target="_blank">پنل مدیریت</a>--}}
{{--                        @endif--}}
{{--                        <a href="{{route('profile',auth()->user()->id)}}"  style="color: black !important;">پروفايل</a>--}}
{{--                        <a href="{{route('user.dashboard')}}" style="color: black !important;">پروفايل</a>--}}
{{--                        <form action="{{route('logout')}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <button type="submit">خروج</button>--}}
{{--                        </form>--}}

{{--                    @else--}}
{{--                        وقتی لاگین نیستسم--}}
{{--                        <a class="dropdown-item" style="color: black !important;" href="{{route('register')}}">ثبت--}}
{{--                            نام</a>--}}
{{--                        <a class="dropdown-item" style="color: black !important;" href="{{route('login')}}">راهیابی</a>--}}
{{--                        <a class="dropdown-item" style="color: black !important;" href="{{route('doctor.register')}}">ثبت نام پزشک</a>--}}
{{--                        <a class="dropdown-item" style="color: black !important;" href="{{route('doctor.login')}}">راهیابی پزشک</a>--}}

{{--                    @endauth--}}


{{--                </div>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-mainbg">
    <div class="container">
        <a class="text-secondary" style="text-decoration: none" href="{{ url('/') }}">
            صفحه اصلی
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->


                @guest



                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            ثبت نام | راهیابی
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-secondary" href="{{route('register')}}">
                                ثبت نام
                            </a>

                            <a class="dropdown-item text-secondary" href="{{route('login')}}">
                                راهیابی
                            </a>

                            <a class="dropdown-item text-secondary" href="{{route('doctor.register')}}">
                                ثبت نام پزشک
                            </a>

                            <a class="dropdown-item text-secondary" href="{{route('doctor.login')}}">
                                راهیابی پزشک
                            </a>

                            <a class="dropdown-item text-secondary" href="{{route('secretary.login')}}">
                                راهیابی منشی
                            </a>

                        </div>
                    </li>

                    {{--                    @if (Route::has('login'))--}}
                    {{--                        <li class="nav-item ">--}}
                    {{--                            <a class="nav-link text-secondary" href="{{ route('login') }}">{{ __('ورود') }}</a>--}}
                    {{--                        </li>--}}
                    {{--                    @endif--}}

                    {{--                    @if (Route::has('register'))--}}
                    {{--                        <li class="nav-item ">--}}
                    {{--                            <a class="nav-link text-secondary" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>--}}
                    {{--                        </li>--}}
                    {{--                    @endif--}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            {{ Auth::user()->family }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(auth()->user()->role==1)
                                <a href="{{route('admin')}}" class="text-secondary" target="_blank">
                                    پنل مدیریت
                                </a>
                            @endif

                            <a href="{{route('user.dashboard')}}" class="text-secondary">داشبورد</a>

                            <a class="dropdown-item text-secondary" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('خروج از حساب کاربری') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>





