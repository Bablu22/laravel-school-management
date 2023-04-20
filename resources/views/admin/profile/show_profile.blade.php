@php
    $name = trim(collect(explode(' ', Auth::user()->name))->map(function ($segment) {
                return mb_substr($segment, 0, 1);
            })->join(' '));
            $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
@endphp
@extends('admin.admin_master')
@section('admin')

    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="/">Main</a></li>
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('profile')}}">Profile</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile: {{$user->name}}</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <!-- Simple card -->
                    <div class="card">
                        <img class="card-img-top img-fluid" src="{{asset('assets/images/small/cover.svg')}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <div class="card-avatar">
                                <a class="card-thumbnail card-inner" href="{{route('profile.edit')}}">
                                    <img class="rounded-circle img-thumbnail img-fluid"
                                         src="{{ (!empty($user->profile_photo_path))? Storage::url('uploads/avatar/'.$user->profile_photo_path):$avatar }}"
                                         alt="avatar">
                                </a>
                            </div>
                            <h3 class="card-title">{{$user->name}}</h3>
                            <h6 class="font-16 mt-0">Email: {{$user->email}}</h6>
                            <h6 class="font-16 mt-0">Phone: {{$user->phone}}</h6>
                            <h6 class="font-16 mt-0">Address: {{$user->address}}</h6>
                            <h6 class="font-16 mt-0">Gender: {{$user->gender}}</h6>
                            <h6 class="font-16 mt-0">Role: {{$user->role}}</h6>
                            <a href="{{route('profile.edit')}}" class="btn btn-primary waves-effect waves-light w-100">Edit
                                Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
