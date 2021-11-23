<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu "></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
                <img class="img-xs rounded-circle" src="{{url('user/images/admin.jpg')}}" alt="admin image">
                <span class="text-black font-weight-bold p-1 ml-1">{{auth()->user()->name}} {{auth()->user()->family}}</span>
            </li>
        </ul>

    </div>
</nav>

