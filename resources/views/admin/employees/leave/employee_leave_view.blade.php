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
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Leave Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">Employee leave lists</h4>
                                <a href="{{route('employee.leave.add')}}" class="btn btn-primary btn-sm">Add
                                    Leave</a>
                            </div>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th>Name</th>
                                    <th>ID No</th>
                                    <th>Purpose</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th width="25%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($allData as $key => $leave )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $leave['user']['name'] }}</td>
                                        <td> {{ $leave['user']['id_no'] }}</td>
                                        <td> {{ $leave['purpose']['name'] }}</td>
                                        <td> {{ $leave->start_date }}</td>
                                        <td> {{ $leave->end_date }}</td>

                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <a href="{{ route('employee.leave.edit',$leave->id) }}"
                                                   class="btn btn-lg btn-primary ion-edit"
                                                   style="float: none; margin:0 5px;">
                                                </a>
                                                <a href="{{ route('employee.leave.delete', $leave->id) }}"
                                                   id="delete"
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
