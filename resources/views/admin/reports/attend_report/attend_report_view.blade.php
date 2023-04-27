@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <h4 class="page-title">Attendance report management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('report.attendance.get')}}" method="GET" novalidate=""
                                  target="_blank">
                                @csrf
                                <div class="row mt-3">

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="employee_id" class="mb-2 pb-1">Employee Name</label>
                                        <select id="employee_id" name="employee_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" selected="" disabled="">Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="mdate" class="mb-2 pb-1">Date of Birth</label>
                                        <input type="date" class="form-control" id="mdate" name="date"
                                               required=""
                                               placeholder="Type address">
                                    </div>

                                </div>

                                <input type="submit" class="btn btn-rounded btn-primary mt-2" value="Submit">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
