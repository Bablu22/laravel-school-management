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
                                <li class="breadcrumb-item"><a href="{{route('employee.salary.view')}}">Employee
                                        Salary</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Registration Management</h4>
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
                                    <th>ID NO</th>
                                    <th>Mobile</th>
                                    <th>Gender</th>
                                    <th>Join Date</th>
                                    <th>Salary</th>

                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allData as $key => $value )
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $value->name }}</td>
                                        <td> {{ $value->id_no }}</td>
                                        <td> {{ $value->phone }}</td>
                                        <td> {{ $value->gender }}</td>
                                        <td> {{ date('d-m-Y',strtotime($value->join_date))  }}</td>
                                        <td> {{ $value->salary }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm waves-effect waves-light"
                                                        data-toggle="modal" data-animation="bounce"
                                                        data-target="#editClassModal{{ $value->id }}"><span
                                                        class="fas fa-plus-square"></span>
                                                </button>
                                                <a href="{{ route('employee.salary.details', $value->id) }}"
                                                   class="tabledit-delete-button btn btn-lg btn-info"
                                                   style="float: none; margin:0 5px;"><span
                                                        class="fas fa-eye"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editClassModal{{ $value->id }}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="editClassModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editClassModalLabel">Salary
                                                        Increment</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update.increment.store', $value->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('post')
                                                        <div class="form-group">
                                                            <label for="className">Salary Amount</label>
                                                            <input type="text" class="form-control" id="className"
                                                                   name="increment_salary" required
                                                                   placeholder="Type salary">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="datepicker" class="mb-2 pb-1">Date</label>
                                                            <input type="date" class="form-control" id="datepicker"
                                                                   name="effected_salary"
                                                                   required=""
                                                                   placeholder="Type date">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
