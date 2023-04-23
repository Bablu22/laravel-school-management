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
                                <li class="breadcrumb-item"><a href="{{route('employee.all')}}">Employees
                                    </a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.leave.view')}}">Employee
                                        Leaves</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Leave add</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="" action="{{route('store.employee.leave')}}" method="POST" novalidate=""
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="employee_id" class="mb-2 pb-1">Employee Name</label>
                                        <select required id="employee_id" name="employee_id"
                                                class="select2 form-control mb-3 custom-select">
                                            <option value="" selected="" disabled="">Select Employee Name</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="mdate" class="mb-2 pb-1">Start Date</label>
                                        <input type="date" class="form-control" id="mdate" name="start_date"
                                               required=""
                                               placeholder="Type address">
                                    </div>


                                </div>

                                <div class="row mt-3">
                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="leave_purpose_id" class="mb-2 pb-1">Leave Purpose</label>
                                        <select name="leave_purpose_id" id="leave_purpose_id" required=""
                                                class="select2 form-control">
                                            <option value="" selected="" disabled="">Select leave purpose</option>
                                            @foreach($leave_purpose as $leave)
                                                <option value="{{ $leave->id }}">{{ $leave->name }}</option>
                                            @endforeach
                                            <option value="0">New Purpose</option>
                                        </select>
                                        <label for="add_another"></label><input type="text" name="name" id="add_another"
                                                                                class="form-control mb-2"
                                                                                placeholder="Write Purpose"
                                                                                style="display: none;">
                                    </div>

                                    <div class="form-group mb-0 col-lg-6">
                                        <label for="datepicker" class="mb-2 pb-1">End Date</label>
                                        <input type="text" class="form-control" id="datepicker" name="end_date"
                                               required=""
                                               placeholder="Type address">
                                    </div>
                                </div>

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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize Select2
            $('#leave_purpose_id').select2();

            // Show/hide input field based on "New Purpose" option
            $('#leave_purpose_id').on('select2:select', function (e) {
                if (e.params.data.id == '0') {
                    $('#add_another').show();
                } else {
                    $('#add_another').hide();
                }
            });

            $('#leave_purpose_id').on('select2:unselect', function (e) {
                $('#add_another').hide();
            });
        });
    </script>
@endsection
