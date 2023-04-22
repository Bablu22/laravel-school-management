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
                                <li class="breadcrumb-item"><a href="{{route('employee.salary.view')}}">Employee
                                        Salary</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Salary Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class=" mb-4">
                                <h5><strong> Employee Name: </strong> {{ $details->name }} </h5>
                                <h5><strong> Employee ID No: </strong> {{ $details->id_no }} </h5>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Previous Salary</th>
                                    <th>Increment Salary</th>
                                    <th>Present Salary</th>
                                    <th>Effected Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($salary_log as $key => $log )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $log->previous_salary }}</td>
                                        <td> {{ $log->increment_salary }}</td>
                                        <td> {{ $log->present_salary }}</td>
                                        <td> {{ $log->effected_salary }}</td>


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
