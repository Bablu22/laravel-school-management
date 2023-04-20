@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        list</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.create')}}">Student
                                        registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Registration</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('student-registration.store')}}" method="POST" novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="name" class="mb-2 pb-1">Student Name</label>
                                        <input type="text" id="name" value="{{old('name')}}" name="name"
                                               class="form-control" required=""
                                               placeholder="Type name">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="father_name" class="mb-2 pb-1">Father's Name</label>
                                        <input type="text" class="form-control" value="{{old('father_name')}}"
                                               id="father_name" name="father_name"
                                               required=""
                                               placeholder="Type father's name">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="mother_name" class="mb-2 pb-1">Mother's Name</label>
                                        <input type="text" id="mother_name" value="{{old('mother_name')}}"
                                               name="mother_name" class="form-control"
                                               required=""
                                               placeholder="Type mother's name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="phone" class="mb-2 pb-1">Mobile Number</label>
                                        <input type="text" id="phone" value="{{old('phone')}}" name="phone"
                                               class="form-control" required=""
                                               placeholder="Type mobile number">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="address" class="mb-2 pb-1">Address</label>
                                        <input type="text" value="{{old('address')}}" class="form-control" id="address"
                                               name="address"
                                               required=""
                                               placeholder="Type address">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="gender" class="mb-2 pb-1">Gender</label>
                                        <select required id="gender" name="gender"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" disabled selected hidden>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="religion" class="mb-2 pb-1">Religion</label>
                                        <input value="{{old('religion')}}" type="text" id="religion" name="religion"
                                               class="form-control"
                                               required=""
                                               placeholder="Type religion">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="mdate" class="mb-2 pb-1">Date of Birth</label>
                                        <input type="date" class="form-control" id="mdate" name="date_of_birth"
                                               required=""
                                               placeholder="Type address">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="discount" class="mb-2 pb-1">Discount</label>
                                        <input value="{{old('discount')}}" type="text" id="discount" name="discount"
                                               class="form-control"
                                               placeholder="0000">
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="year" class="mb-2 pb-1">Year</label>
                                        <select required id="year" name="year"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="class" class="mb-2 pb-1">Class</label>
                                        <select required id="class" name="class"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($classes as $class)
                                                @php
                                                    $className = \App\Models\StudentClass::where('id', $class->class_id)->value('name');
                                                @endphp
                                                <option value="{{ $class->class_id }}">{{ $className }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="group" class="mb-2 pb-1">Group</label>
                                        <select required id="group" name="group"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="shift" class="mb-2 pb-1">Shift</label>
                                        <select required id="shift" name="shift"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($shifts as $shift)
                                                <option value="{{$shift->id}}">{{$shift->name}}</option>
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
