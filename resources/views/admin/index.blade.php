<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url('admin/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/css/shared/style.css')}}">
    <link rel="stylesheet" href="{{url('admin/assets/css/demo_1/style.css')}}">
{{--    <link rel="shortcut icon" href="{{url('admin/assets/images/favicon.ico')}}"/>--}}
</head>

<body class="rtl">

<div class="container-scroller">
    @include('admin.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('admin.sidebar')
        @yield('content')
    </div>
</div>

<script src="{{url('admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{url('admin/assets/vendors/js/vendor.bundle.addons.js')}}"></script>
<script src="{{url('admin/assets/js/shared/off-canvas.js')}}"></script>
<script src="{{url('admin/assets/js/shared/misc.js')}}"></script>
<script src="{{url('admin/assets/js/demo_1/dashboard.js')}}"></script>

</body>
</html>
