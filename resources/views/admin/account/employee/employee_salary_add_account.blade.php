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
                            <form method="POST" action="{{ route('account.salary.store') }}">
                                @csrf
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>ID No</th>
                                        <th>Name</th>
                                        <th>Basic Salary</th>
                                        <th>Total Salary</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($employeeAttendances as $key => $row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $row['id_no'] }}</td>
                                            <td>{{ $row['name'] }}</td>
                                            <td>{{ $row['salary'] }}</td>
                                            <td>{{ $row['total_salary'] }}</td>
                                            <td>
                                                <input type="checkbox" name="selected[]" value="{{ $key }}"/>
                                                <input type="hidden" name="employee_id[{{ $row['id'] }}]" value="{{ $row['employee_id'] }}" />
                                                <input type="hidden" name="salary[{{ $row['id'] }}]" value="{{ $row['salary'] }}" />
                                                <input type="hidden" name="total_salary[{{ $row['id'] }}]" value="{{ $row['total_salary'] }}" />
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="mdate">Date:</label>
                                    <input type="date" class="form-control" id="mdate" name="date" required>
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
