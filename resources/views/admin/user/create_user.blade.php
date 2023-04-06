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
                                <li class="breadcrumb-item"><a href="{{route('user.create')}}">Add User</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add New User</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">


                            <form class="" action="{{route('user.store')}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group mb-0">
                                    <label for="name" class="my-2 py-1">Name</label>
                                    <div>
                                        <input type="text" name="name" id="name" class="form-control" required=""
                                               parsley-type="text"
                                               value="{{old('name')}}"
                                               placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="email" class="my-2 py-1">E-Mail</label>
                                    <div>
                                        <input type="email" class="form-control" id="email" name="email" required=""
                                               parsley-type="email" value="{{old('email')}}"
                                               placeholder="Enter a valid e-mail">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="role" class="my-2 py-1">Role</label>
                                    <div>
                                        <select id="role" name="role"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" disabled selected hidden>Select</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="password" class="my-2 py-1">Password</label>
                                    <div class=" ">
                                        <input type="text" name="password" id="password"
                                               class="form-control" required="" value="{{old('password')}}"
                                               placeholder="Enter password">
                                    </div>
                                    <button type="button" id="generate-password-btn"
                                            class="btn btn-outline-primary waves-effect waves-light btn-sm mt-2">
                                        Generate password
                                    </button>
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Submit
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
