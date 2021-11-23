@extends('admin.index')
@section('title')
    پنل مديريت - مديريت كاربران
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header  card-header-color text-white" >{{ __('مدیریت کاربران') }}</div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">
                                <thead class="address-box-color" >
                                <tr>
                                    <th>نام</th>
                                    <th>نام خانوادگي</th>
                                    <th>كدملي</th>
                                    <th>ايميل</th>
                                    <th>تلفن</th>
                                    <th>نقش</th>
                                    <th>وضعيت</th>
                                    <th>مديريت</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($users as $user)

                                    @switch($user->role)
                                        @case(1)
                                        @php $role='مدير' @endphp
                                        @break
                                        @case(2)
                                        @php $role='كاربر' @endphp
                                        @break
                                        @default
                                    @endswitch

                                    @switch($user->status)
                                        @case(1)
                                        @php
                                            $url=route('admin.user.status',$user->id);
                                            $status= '<a href="'.$url.'" class="badge my-color text-white">فعال</a>'
                                        @endphp
                                        @break

                                        @case(0)
                                        @php
                                            $url=route('admin.user.status',$user->id);
                                            $status='<a href="'.$url.'" class="badge badge-secondary text-black">غیرفعال</a>';
                                        @endphp
                                        @break
                                        @default
                                    @endswitch
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->family}}</td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$role}}</td>
                                        <td>{!! $status !!}</td>
                                        <td>
                                            <a  href="{{route('admin.user.delete',$user->id)}}"
                                               onclick="return confirm('ايا مايل به حذف كاربر هستيد')"><label
                                                    class="badge red-color text-white ">حذف</label></a>
                                            <a href="{{route('admin.profile',$user->id)}}"><label
                                                    class="badge blue-color text-white">ويرايش</label></a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                {{$users->links()}}
            </div>

        </div>
        @include('admin.footer')
    </div>
@endsection
