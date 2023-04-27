@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('employee.attendance.view')}}">Employee
                                        Attendance</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.all')}}">Employees</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student fee account management</h4>
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
                                <div>
                                    <a href="{{route('account.salary.add')}}" class="btn btn-primary btn-sm">Add
                                        Salary</a>
                                </div>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>ID No</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($allData as $key => $value )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $value['user']['id_no'] }}</td>
                                        <td> {{ $value['user']['name'] }}</td>
                                        <td> {{ $value->amount }}</td>
                                        <td> {{ date('M Y', strtotime($value->date))  }}</td>

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
