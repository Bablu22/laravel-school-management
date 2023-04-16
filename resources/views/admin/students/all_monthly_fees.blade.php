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

                            {{--                            <table id="datatable" class="table table-bordered">--}}
                            {{--                                <thead>--}}
                            {{--                                <tr>--}}
                            {{--                                    <th>SL</th>--}}
                            {{--                                    <th>Class</th>--}}
                            {{--                                    <th>Fee Category</th>--}}
                            {{--                                    <th>Amount</th>--}}
                            {{--                                    <th>Created At</th>--}}
                            {{--                                    <th>Action</th>--}}
                            {{--                                </tr>--}}
                            {{--                                </thead>--}}
                            {{--                                <tbody>--}}
                            {{--                                @foreach($feeAmounts as $key=> $amount)--}}
                            {{--                                    <tr>--}}
                            {{--                                        <td>{{$key+1}}</td>--}}
                            {{--                                        <td>{{$amount['student_class']['name']}}</td>--}}
                            {{--                                        <td>{{$amount['fee_category']['name']}}</td>--}}
                            {{--                                        <td>{{$amount->amount}}</td>--}}
                            {{--                                        <td>{{ $amount->created_at->format('d M Y') }}</td>--}}
                            {{--                                        <td>--}}
                            {{--                                            <div class="btn-group btn-group-sm" style="float: none;">--}}

                            {{--                                                <a href="{{ route('fee_category_amount.destroy', $amount->id) }}"--}}
                            {{--                                                   id="delete"--}}
                            {{--                                                   class="tabledit-delete-button btn btn-lg btn-danger"--}}
                            {{--                                                   style="float: none; margin:0 5px;"><span--}}
                            {{--                                                        class="ti-trash text-white"></span>--}}
                            {{--                                                </a>--}}
                            {{--                                            </div>--}}
                            {{--                                        </td>--}}
                            {{--                                    </tr>--}}

                            {{--                                @endforeach--}}
                            {{--                                </tbody>--}}
                            {{--                            </table>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
