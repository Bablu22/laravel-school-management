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
                                               value="{{ $editData['0']['date'] }}"
                                               placeholder="Type address">
                                    </div>
                                </div>


                                <table class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                        <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">Attendance Status</th>
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
                                    @foreach($editData as $key => $data)

                                        <tr id="div{{$data->id}}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $data->employee_id }}">
                                            <td>{{ $key+1  }}</td>
                                            <td>{{ $data['user']['name'] }}</td>

                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">

                                                    <input name="attend_status{{$key}}" type="radio" value="Present" id="present{{$key}}" checked="checked" {{ ($data->attend_status == 'Present')?'checked':'' }} >
                                                    <label for="present{{$key}}">Present</label>

                                                    <input name="attend_status{{$key}}" value="Leave" type="radio" id="leave{{$key}}"  {{ ($data->attend_status == 'Leave')?'checked':'' }}  >
                                                    <label for="leave{{$key}}">Leave</label>

                                                    <input name="attend_status{{$key}}" value="Absent"  type="radio" id="absent{{$key}}"  {{ ($data->attend_status == 'Absent')?'checked':'' }}  >
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
