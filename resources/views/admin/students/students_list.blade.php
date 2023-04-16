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
                                        Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        Registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Registration Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">Assign Subject</h4>
                                <a href="{{route('student-registration.create')}}" class="btn btn-primary btn-sm">Add
                                    Student</a>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Group</th>
                                    <th>Shift</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($assignStudents as $key=> $student)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            <img
                                                src="{{ (!empty($student['student']['profile_photo_path']))? Storage::url('uploads/avatar/'.$student['student']['profile_photo_path']) : Storage::url('uploads/avatar/no-image.png') }}"
                                                height="64"
                                                alt="user"
                                                class="rounded">
                                        </td>
                                        <td>{{$student['student']['name']}}</td>
                                        <td>{{$student['student']['id_no']}}</td>
                                        <td>{{$student['student']['roll']}}</td>
                                        <td>{{$student['year']['name']}}</td>
                                        <td>{{$student['class']['name']}}</td>
                                        <td>{{$student['group']['name']}}</td>
                                        <td>{{$student['shift']['name']}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <a href="{{ route('student-registration.update', $student->student_id) }}"
                                                   class="btn btn-lg btn-primary ion-edit"
                                                   style="float: none; margin:0 5px;">
                                                </a>
                                                <a href="{{ route('student-registration.details', $student->student_id) }}"
                                                   class="tabledit-delete-button btn btn-lg btn-info"
                                                   style="float: none; margin:0 5px;"><span
                                                        class=" mdi mdi-eye text-white"></span>
                                                </a>
                                                <a href="{{ route('student-registration.delete', $student->student_id) }}"
                                                   class="tabledit-delete-button btn btn-lg btn-danger"
                                                   style="float: none; margin:0 5px;"><span
                                                        class=" mdi mdi-delete text-white"></span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
