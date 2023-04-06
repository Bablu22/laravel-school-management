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
                                <li class="breadcrumb-item"><a href="{{route('user.all')}}">Manage User</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.update',$user->id)}}">Update User</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update User:{{$user->name}}</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{route('user.store.update',$user->id)}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group mb-0">
                                    <label for="name" class="my-2 py-1">Name</label>
                                    <div>
                                        <input value="{{$user->name}}" type="text" name="name" id="name"
                                               class="form-control" required=""
                                               parsley-type="text"
                                               placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="email" class="my-2 py-1">E-Mail</label>
                                    <div>
                                        <input value="{{$user->email}}" type="email" class="form-control" id="email"
                                               name="email" required=""
                                               parsley-type="email"
                                               placeholder="Enter a valid e-mail">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="role" class="my-2 py-1">Role</label>
                                    <div>
                                        <select id="role" name="role" class="form-control" required="">
                                            <option value="user" {{$user->role=='user'?"selected":""}}>User</option>
                                            <option value="admin" {{$user->role=='admin'?"selected":""}}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
