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
                                <li class="breadcrumb-item"><a href="{{route('profile.edit')}}">Profile setting</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit your profile</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{route('profile.store',$user->id)}}"
                                  method="POST" enctype="multipart/form-data">
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
                                <div class="form-group mb-0">
                                    <label for="phone" class="my-2 py-1">Phone</label>
                                    <div>
                                        <input value="{{$user->phone}}" type="text" class="form-control" id="phone"
                                               name="phone" required=""
                                               parsley-type="email"
                                               placeholder="Enter phone">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="address" class="my-2 py-1">Address</label>
                                    <div>
                                        <input value="{{$user->address}}" type="text" class="form-control" id="address"
                                               name="address" required=""
                                               parsley-type="address"
                                               placeholder="Enter address">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="gender" class="my-2 py-1">Gender</label>
                                    <div>
                                        <select required id="gender" name="gender"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" disabled selected hidden>Select</option>
                                            <option value="Male" {{$user->gender=='Male'?"selected":""}}>Male</option>
                                            <option value="Female" {{$user->gender=='Female'?"selected":""}}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="photo" class="my-2 py-1">Image</label>
                                    <input type="file" name="photo" id="photo" class="dropify"/>
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
