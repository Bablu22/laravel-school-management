@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('class.all')}}">Setup Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('class.all')}}">Setup</a></li>
                                <li class="breadcrumb-item"><a href="{{route('fee_category_amount.all')}}">Fee
                                        Amount</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Fee Amount Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">All Fees Amounts</h4>
                                <a href="{{route('monthly-fee.create')}}" class="btn btn-primary btn-sm">Add
                                    Month Fee</a>
                            </div>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Group</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($monthly_fees as $key=> $amount)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$amount['student']['name']}}</td>
                                        <td>{{$amount['student']['roll']}}</td>
                                        <td>{{$amount['year']['name']}}</td>
                                        <td>{{$amount['class']['name']}}</td>
                                        <td>{{$amount['group']['name']}}</td>
                                        <td>{{$amount->month}}</td>
                                        <td>{{$amount->amount}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{route("monthly-fee.payslip") . '?student_id=' . $amount->student_id}}">Fee
                                                Slip</a>
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
