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
                                @foreach ($allStudents as $student)
                                    @php
                                        $fee_category_id = \App\Models\FeeCategory::where('name', 'LIKE', '%registration%')->value('id');
                                        $registration_fee = \App\Models\FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                                            ->where('class_id', $student['class']['id'])
                                            ->first();
                                        $original_fee = $registration_fee ? $registration_fee->amount : 0;
                                        $discount = $student['discount']['discount'];
                                        $discounted_fee = $discount / 100 * $original_fee;
                                        $registrationFee = number_format((float)$original_fee - (float)$discounted_fee, 2, '.', '');
                                    @endphp
                                    <tr>
                                        <td>{{ $student['student']['name'] }}</td>
                                        <td>{{ $student['student']['id_no'] }}</td>
                                        <td>{{ $student['student']['roll'] }}</td>
                                        <td>{{ $student['year']['name'] }}</td>
                                        <td>{{ $student['class']['name']}}</td>
                                        <td>{{ $original_fee }}</td>
                                        <td>{{ $discount }}%</td>
                                        <td>{{ $registrationFee }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route("reg-fee.payslip") . '?class_id=' . $student->class_id . '&student_id=' . $student->student_id}}">Fee Slip</a>
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



