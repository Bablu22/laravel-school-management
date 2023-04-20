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
                                <li class="breadcrumb-item"><a href="{{route('exam-fee.all')}}">Exam Fees</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Student Monthly Fee</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('exam-fee.store')}}" method="POST" novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="year" class="mb-2 pb-1">Year</label>
                                        <select required id="year" name="year"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($years as $year)
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-4">
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
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="group" class="mb-2 pb-1">Group</label>
                                        <select required id="class" name="group"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="name" class="mb-2 pb-1">Student Name</label>
                                        <select required id="year" name="name"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($students as $student)
                                                <option
                                                    value="{{$student['student']['name']}}">{{$student['student']['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="roll" class="mb-2 pb-1">Student Roll</label>
                                        <select required id="class" name="roll"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($students as $student)
                                                <option
                                                    value="{{$student['student']['roll']}}">{{$student['student']['roll']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="discount" class="mb-2 pb-1">Discount</label>
                                        <input value="{{old('discount')}}" type="text" id="discount" name="discount"
                                               class="form-control"
                                               placeholder="0000">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-4">
                                        <label for="exam_type" class="mb-2 pb-1">Exam Type</label>
                                        <select required id="exam_type" name="exam_type"
                                                class="select2 form-control mb-3 custom-select">
                                            <option disabled selected hidden>Select</option>
                                            @foreach($examTypes as $exam)
                                                <option
                                                    value="{{$exam->id}}">{{$exam->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
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
