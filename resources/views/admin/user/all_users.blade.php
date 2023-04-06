@php
    $i=1;
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
                                <li class="breadcrumb-item"><a href="/">Manage Users</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Manage Users</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">All Users</h4>
                                <a href="{{route('user.create')}}" class="btn btn-primary text-white btn-sm">Add
                                    User</a>
                            </div>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <img class="d-flex align-self-end mr-3 rounded"
                                                 src="{{ (!empty($user->profile_photo_path))? Storage::url('uploads/avatar/'.$user->profile_photo_path):$avatar }}"
                                                 alt="Generic placeholder image"
                                                 height="64">
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->status ==1 ?"Active":"Deactivated"}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                @if ($user->status==0)
                                                    <form method="POST"
                                                          action="{{ route('users.activate', $user->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="tabledit-edit-button btn btn-sm btn-info"
                                                                style="float: none; margin: 5px;" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Active User">
                                                            <span class="fas fa-user-alt text-white"></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST"
                                                          action="{{ route('users.deactivate', $user->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                                class="tabledit-edit-button btn btn-sm btn-info"
                                                                style="float: none; margin: 5px;" data-toggle="tooltip"
                                                                data-placement="top"
                                                                data-original-title="Deactivate User">
                                                            <span class="fas fa-user-alt-slash text-white"></span>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{route('user.update',$user->id)}}"
                                                   class="tabledit-delete-button btn btn-sm btn-primary"
                                                   style="float: none; margin: 5px;"><span
                                                        class="mdi mdi-border-color text-white"></span>
                                                </a>

                                                <a href="{{ route('user.destroy', $user->id) }}" id="delete"
                                                   class="tabledit-delete-button btn btn-sm btn-danger"
                                                   style="float: none; margin: 5px;"><span
                                                        class="ti-trash text-white"></span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
