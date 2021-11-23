@extends('admin.index')
@section('title')
پنل مدیریت
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header  card-header-color text-white" >{{ __('داشبورد') }}</div>
                    <div class="card-body table-responsive">
                        <div class="row mb-5 text-black">
                            ادمین عزیز
                            {{auth()->user()->name}} {{auth()->user()->family}}
                            به پنل مدیریت خوش آمدید.
                        </div>
                        <div class="row">
                            <a href="{{route('admin.users')}}" class="btn btn-sm card-header-color text-white  mt-1">مدیریت کاربران</a>
                            <a href="{{route('admin.doctors')}}" class="btn btn-sm my-color text-white ml-2 mt-1">مدیریت پزشکان</a>
                            <a href="{{route('admin.secretaries')}}" class="btn btn-sm text-white red-color ml-2 mt-1">مدیریت منشی‌ها</a>
                            <a href="{{route('admin.categories')}}" class="btn btn-sm text-white button-color1 ml-2 mt-1">مدیریت تخصص‌ها</a>

                        </div>
                    </div>

                </div>

            </div>
        </div>



    </div>
    @include('admin.footer')
</div>
@endsection
