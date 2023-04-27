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
                        <h4 class="page-title">Student ID Card Generate</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('report.student.idcard.get')}}" method="GET" novalidate=""
                                  target="_blank">
                                @csrf
                                <div class="row mt-3">

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="year_id" class="mb-2 pb-1">Year</label>
                                        <select id="year_id" name="year_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="class_id" class="mb-2 pb-1">Class</label>
                                        <select id="class_id" name="class_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($class as $c)
                                                <option value="{{ $c->id }}">{{ $c->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-rounded btn-primary mt-2" value="Search">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
