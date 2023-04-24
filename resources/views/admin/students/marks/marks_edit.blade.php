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
                        <h4 class="page-title">Student Registration</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('marks.entry.update')}}" method="POST" novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
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
                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="assign_subject_id" class="mb-2 pb-1">Subject</label>
                                        <select name="assign_subject_id" id="assign_subject_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option selected="">Select Subject</option>

                                        </select>
                                    </div>
                                    <div class="form-group mb-0 col-lg-3">
                                        <label for="exam_type_id" class="mb-2 pb-1">Exam Type</label>
                                        <select name="exam_type_id" id="exam_type_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" selected="" disabled="">Select Class</option>
                                            @foreach($exam_types as $exam)
                                                <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>

                                </div>
                                <div class="form-group mt-3 mb-0">
                                    <a id="search" class="btn text-white btn-primary" name="search"> Search</a>
                                </div>

                                <div class="row d-none mt-3" id="marks-entry">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Gender</th>
                                                <th>Marks</th>
                                            </tr>
                                            </thead>
                                            <tbody id="marks-entry-tr">

                                            </tbody>

                                        </table>
                                        <input type="submit" class="btn btn-rounded btn-primary" value="Submit">

                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function () {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            $.ajax({
                url: "{{ route('student.edit.getstudents')}}",
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'assign_subject_id': assign_subject_id,
                    'exam_type_id': exam_type_id
                },
                success: function (data) {
                    $('#marks-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function (key, v) {
                        html +=
                            '<tr>' +
                            '<td>' + v.student.id_no + '<input type="hidden" name="student_id[]" value="' + v.student_id + '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no + '"> </td>' +
                            '<td>' + v.student.name + '</td>' +
                            '<td>' + v.student.fname + '</td>' +
                            '<td>' + v.student.gender + '</td>' +
                            '<td><input type="text" class="form-control form-control-sm" name="marks[]" value=" ' + v.marks + ' " ></td>' +
                            '</tr>';
                    });
                    html = $('#marks-entry-tr').html(html);
                }
            });
        });

    </script>

    <script type="text/javascript">
        $(function () {
            $(document).on('change', '#class_id', function () {
                const class_id = $('#class_id').val();
                $.ajax({
                    url: "{{ route('marks.getsubject') }}",
                    type: "GET",
                    data: {class_id: class_id},
                    success: function (data) {
                        let html = '<option value="">Select Subject</option>';
                        $.each(data, function (key, v) {
                            html += '<option value="' + v.id + '">' + v.subject.name + '</option>';
                        });
                        $('#assign_subject_id').html(html);
                    }
                });
            });
        });
    </script>
@endsection
