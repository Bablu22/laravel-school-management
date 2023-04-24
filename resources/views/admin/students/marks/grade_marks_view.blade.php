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
                        <h4 class="page-title">Marks Grade Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">Marks grade list</h4>
                                <a href="{{route('marks.grade.add')}}" class="btn btn-primary btn-sm">Add
                                    Mark Grade</a>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Grade Name</th>
                                    <th>Grade Point</th>
                                    <th>Start Marks</th>
                                    <th>End Marks</th>
                                    <th>Point Range</th>
                                    <th>Remarks</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($allData as $key => $value )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $value->grade_name }}</td>
                                        <td> {{ number_format((float)$value->grade_point,2)  }}</td>
                                        <td> {{ $value->start_marks }}</td>
                                        <td> {{ $value->end_marks }}</td>
                                        <td> {{ $value->start_point }} - {{ $value->end_point }}</td>
                                        <td> {{ $value->remarks }}</td>

                                        <td>
                                            <a href="{{ route('marks.grade.edit',$value->id) }}"
                                               class="btn btn-lg btn-primary ion-edit"
                                               style="float: none; margin:0 5px;">
                                            </a>
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
