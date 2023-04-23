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
                            <form method="post" action="{{ route('store.employee.attendance') }}">
                                @csrf
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="form-group">
                                        <label for="mdate" class="mb-2 pb-1">Attendance Date</label>
                                        <input type="date" class="form-control" id="mdate" name="date"
                                               required=""
                                               placeholder="Type address">
                                    </div>
                                </div>


                                <table id="datatable" class="table table-bordered  " style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee
                                            Name
                                        </th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee
                                            ID
                                        </th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">
                                            Attendance Status
                                        </th>
                                    </tr>

                                    <tr>
                                        <th class="text-center btn present_all"
                                            style="display: table-cell; background-color: #1E245A;color: #FFFFFF">
                                            Present
                                        </th>
                                        <th class="text-center btn leave_all"
                                            style="display: table-cell; background-color: #1E245A;color: #FFFFFF">Leave
                                        </th>
                                        <th class="text-center btn absent_all"
                                            style="display: table-cell; background-color: #1E245A;color: #FFFFFF">Absent
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $key => $employee)

                                        <tr id="div{{$employee->id}}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                            <td>{{ $key+1  }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->id_no }}</td>

                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">

                                                    <input name="attend_status{{$key}}" type="radio" value="Present"
                                                           id="present{{$key}}" checked="checked">
                                                    <label for="present{{$key}}">Present</label>

                                                    <input name="attend_status{{$key}}" value="Leave" type="radio"
                                                           id="leave{{$key}}">
                                                    <label for="leave{{$key}}">Leave</label>

                                                    <input name="attend_status{{$key}}" value="Absent" type="radio"
                                                           id="absent{{$key}}">
                                                    <label for="absent{{$key}}">Absent</label>

                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group mb-0">
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
