@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('employee.all')}}">Employee
                                        Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.all')}}">Employees
                                    </a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.create')}}">Employee
                                        Registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Registration</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('employee.update',$editData->id)}}" method="POST"
                                  novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="name" class="mb-2 pb-1">Employee Name</label>
                                        <input type="text" id="name" value="{{$editData->name}}" name="name"
                                               class="form-control" required=""
                                               placeholder="Type name">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="father_name" class="mb-2 pb-1">Father's Name</label>
                                        <input type="text" class="form-control" value="{{$editData->father_name}}"
                                               id="father_name" name="father_name"
                                               required=""
                                               placeholder="Type father's name">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="mother_name" class="mb-2 pb-1">Mother's Name</label>
                                        <input type="text" id="mother_name" value="{{$editData->mother_name}}"
                                               name="mother_name" class="form-control"
                                               required=""
                                               placeholder="Type mother's name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="phone" class="mb-2 pb-1">Mobile Number</label>
                                        <input type="text" id="phone" value="{{$editData->phone}}" name="phone"
                                               class="form-control" required=""
                                               placeholder="Type mobile number">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="address" class="mb-2 pb-1">Address</label>
                                        <input type="text" value="{{$editData->address}}" class="form-control"
                                               id="address"
                                               name="address"
                                               required=""
                                               placeholder="Type address">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="gender" class="mb-2 pb-1">Gender</label>
                                        <select required id="gender" name="gender"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" selected="" disabled="">Select Gender</option>
                                            <option value="Male" {{ ($editData->gender == 'Male')? 'selected': '' }} >
                                                Male
                                            </option>
                                            <option
                                                value="Female" {{ ($editData->gender == 'Female')? 'selected': '' }}>
                                                Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="religion" class="mb-2 pb-1">Religion</label>
                                        <input value="{{$editData->religion}}" type="text" id="religion" name="religion"
                                               class="form-control"
                                               required=""
                                               placeholder="Type religion">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="mdate" class="mb-2 pb-1">Date of Birth</label>
                                        <input type="date" class="form-control" id="mdate" name="date_of_birth"
                                               required=""
                                               value="{{ $editData->date_of_birth }}"
                                               placeholder="Type address">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="designation" class="mb-2 pb-1">Designation</label>
                                        <select required id="designation" name="designation_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($designations as $designation)
                                                <option
                                                    value="{{ $designation->id }}" {{ ($editData->designation_id == $designation->id)?'selected':'' }} >{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="form-group mb-0 col-lg-6">
                                        <input type="file" name="profile_photo_path" id="input-file-now"
                                               class="dropify">
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
