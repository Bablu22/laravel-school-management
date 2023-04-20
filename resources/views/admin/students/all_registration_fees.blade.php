@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        Registration</a></li>
                                <li class="breadcrumb-item"><a href="{{route('reg-fee.all')}}">
                                        Registration fees</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Registration fees Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Search here to get list of fees</h4>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Registration Fees</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($registrationFees as $registrationFee)
                                    <tr>
                                        <td>{{ $registrationFee['name'] }}</td>
                                        <td>{{ $registrationFee['id_no'] }}</td>
                                        <td>{{ $registrationFee['roll'] }}</td>
                                        <td>{{ $registrationFee['year'] }}</td>
                                        <td>{{ $registrationFee['class']}}</td>
                                        <td>{{ $registrationFee['original_fee']}}</td>
                                        <td>{{ $registrationFee['discount']}}</td>
                                        <td>{{ $registrationFee['registrationFee']}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route("reg-fee.payslip") . '?class_id=' . $registrationFee['class_id'] . '&student_id=' . $registrationFee['student_id']}}">Fee Slip</a>
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



