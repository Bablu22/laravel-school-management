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
                                <li class="breadcrumb-item"><a href="{{route('employee.create')}}">Employee
                                        Registration</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.attendance.view')}}">Employee
                                        Attendance</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Attendance Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">Employee List</h4>
                                <a href="{{route('employee.create')}}" class="btn btn-primary btn-sm">Add
                                    Employee</a>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Date</th>
                                    <th>Attend Status</th>


                                </tr>
                                </thead>
                                <tbody>

                                @foreach($details as $key => $value )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $value['user']['name'] }}</td>
                                        <td> {{ $value['user']['id_no'] }}</td>
                                        <td> {{ date('d-m-Y', strtotime($value->date)) }}</td>
                                        <td> {{ $value->attend_status }}</td>


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
