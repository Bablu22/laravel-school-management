@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('student.fee.view')}}">Student Fee</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student exam fee account management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('account.fee.store') }}">
                                @csrf
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>ID No</th>
                                        <th>Roll No</th>
                                        <th>Year</th>
                                        <th>Class</th>
                                        <th>Fee</th>
                                        <th>Discount</th>
                                        <th> Total</th>
                                        <th>Category</th>
                                        <th>Pay</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($examFees as $index => $fee)
                                        <tr>
                                            <td>{{ $fee['name'] }}</td>
                                            <td>{{ $fee['id_no'] }}</td>
                                            <td>{{ $fee['roll'] }}</td>
                                            <td>{{ $fee['year'] }}</td>
                                            <td>{{ $fee['class'] }}</td>
                                            <td>{{ $fee['original_fee'] }}</td>
                                            <td>{{ $fee['discount'] }}</td>
                                            <td>{{ $fee['fee'] }}</td>
                                            <td>{{ $fee['fee_category_name'] }}</td>
                                            <td>
                                                <input type="hidden" name="student_id[{{ $index }}]"
                                                       value="{{ $fee['student_id'] }}">
                                                <input type="hidden" name="original_fee[{{ $index }}]"
                                                       value="{{ $fee['original_fee'] }}">
                                                <input type="hidden" name="discount[{{ $index }}]"
                                                       value="{{ $fee['discount'] }}">
                                                <input type="hidden" name="fee[{{ $index }}]"
                                                       value="{{ $fee['fee'] }}">
                                                <input type="hidden" name="year_id[{{ $index }}]"
                                                       value="{{ $fee['year_id'] }}">
                                                <input type="hidden" name="class_id[{{ $index }}]"
                                                       value="{{ $fee['class_id'] }}">
                                                <input type="hidden" name="fee_category_id[{{ $index }}]"
                                                       value="{{ $fee['fee_category_id'] }}">
                                                <input type="checkbox" name="checkmanage[{{ $index }}]" value="1">
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
