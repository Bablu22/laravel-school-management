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
                        <h4 class="page-title">Employee Salary Management</h4>
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
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>ID NO</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>
                                    @if(Auth::user()->role == "Admin")
                                        <th>Code</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($allData as $key => $employee )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <img
                                                src="{{ (!empty($employee->profile_photo_path))? Storage::url('uploads/employee/'.$employee->profile_photo_path) : Storage::url('uploads/avatar/no-image.png') }}"
                                                height="64"
                                                alt="user"
                                                class="rounded">
                                        </td>
                                        <td> {{ $employee->name }}</td>
                                        <td> {{ $employee->id_no }}</td>
                                        <td> {{ $employee->phone }}</td>
                                        <td> {{ $employee->gender }}</td>
                                        <td> {{ $employee->join_date }}</td>
                                        <td> {{ $employee->salary }}</td>
                                        @if(Auth::user()->role == "Admin")
                                            <td> {{ $employee->code }}</td>
                                        @endif
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <a href="{{ route('employee.edit',$employee->id) }}"
                                                   class="btn btn-lg btn-primary ion-edit"
                                                   style="float: none; margin:0 5px;">
                                                </a>
                                                <a href="{{ route('employee.details', $employee->id) }}"
                                                   class="tabledit-delete-button btn btn-lg btn-info"
                                                   style="float: none; margin:0 5px;"><span
                                                        class=" mdi mdi-eye text-white"></span>
                                                </a>
                                                <a href="{{ route('employee.delete', $employee->id) }}"
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
