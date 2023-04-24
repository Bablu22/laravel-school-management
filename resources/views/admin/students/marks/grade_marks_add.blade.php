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
                                <li class="breadcrumb-item"><a href="{{route('marks.entry.grade')}}">Grade Marks</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Marks Grade Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="" action="{{route('store.marks.grade')}}" method="POST" novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="grade_name" class="mb-2 pb-1">Grade Name</label>
                                        <input type="text" id="grade_name" value="{{old('grade_name')}}"
                                               name="grade_name"
                                               class="form-control" required=""
                                               placeholder="Type grade name">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="grade_point" class="mb-2 pb-1">Grade Point</label>
                                        <input type="text" class="form-control" value="{{old('grade_point')}}"
                                               id="grade_point" name="grade_point"
                                               required=""
                                               placeholder="Type grade point">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="start_marks" class="mb-2 pb-1">Start Marks</label>
                                        <input type="text" id="start_marks" value="{{old('start_marks')}}"
                                               name="start_marks" class="form-control"
                                               required=""
                                               placeholder="Type start marks">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="end_marks" class="mb-2 pb-1">End Marks</label>
                                        <input type="text" id="end_marks" value="{{old('end_marks')}}"
                                               name="end_marks"
                                               class="form-control" required=""
                                               placeholder="Type end marks">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="start_point" class="mb-2 pb-1">Start Point</label>
                                        <input type="text" class="form-control" value="{{old('start_point')}}"
                                               id="start_point" name="start_point"
                                               required=""
                                               placeholder="Type start point">
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="end_point" class="mb-2 pb-1">End Point</label>
                                        <input type="text" id="end_point" value="{{old('end_point')}}"
                                               name="end_point" class="form-control"
                                               required=""
                                               placeholder="Type end point">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="remarks" class="mb-2 pb-1">Remarks</label>
                                        <input type="text" id="remarks" value="{{old('remarks')}}"
                                               name="remarks"
                                               class="form-control" required=""
                                               placeholder="Type remarks">
                                    </div>
                                </div>
                                <div class="form-group mb-0 mt-2">
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
