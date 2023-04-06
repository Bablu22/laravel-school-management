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
                                <li class="breadcrumb-item"><a href="{{route('profile.show')}}">Profile</a></li>
                                <li class="breadcrumb-item"><a href="{{route('password.change')}}">Change password</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Starter</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('password.store')}}" method="POST">
                                @csrf
                                @method('post')
                                <div class="form-group mb-0">
                                    <label for="current_password" class="my-2 py-1">Current Password</label>
                                    <div>
                                        <input type="password" id="current_password"
                                               class="form-control parsley-success"
                                               name="current_password"
                                               value="{{old('current_password')}}"
                                               required="" placeholder="Current password">
                                        @error('current_password')
                                        <ul class="parsley-errors-list filled" id="parsley-id-9">
                                            <li class="">{{$message}}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="password" class="my-2 py-1">New Password</label>
                                    <div>
                                        <input type="password" id="password"
                                               class="form-control parsley-success"
                                               name="password"
                                               value="{{old('password')}}"
                                               required="" placeholder="New password">
                                        @error('password')
                                        <ul class="parsley-errors-list filled" id="parsley-id-9">
                                            <li class="parsley-required">{{$message}}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="password_confirmation" class="my-2 py-1">Confirm Password</label>
                                    <div>
                                        <input type="password" id="password_confirmation"
                                               class="form-control parsley-success"
                                               name="password_confirmation"
                                               value="{{old('password_confirmation')}}"
                                               required="" placeholder="Password confirmation">
                                        @error('password_confirmation')
                                        <ul class="parsley-errors-list filled" id="parsley-id-9">
                                            <li class="parsley-required">{{$message}}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-3">
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
