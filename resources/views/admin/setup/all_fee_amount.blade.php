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
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-animation="bounce"
                                        data-target=".bs-example-modal-center">Add Fee
                                </button>
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                     aria-labelledby="mySmallModalLabel" style="display: none;"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Fee Amount</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('fee_category_amount.store')}}" method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <div class="form-group mb-0">
                                                        <label for="category" class="mb-2 pb-1">Select Fee
                                                            Category</label>
                                                        <select required id="category" name="fee_category_id"
                                                                class="select2 form-control mb-3 custom-select">
                                                            <option value="" disabled selected hidden>Select
                                                            </option>
                                                            @foreach($fee_categories as $category)
                                                                <option
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="class_id" class="mb-2 pb-1">Select Class</label>
                                                        <select required id="class_id" name="class_id"
                                                                class="select2 form-control mb-3 custom-select">
                                                            <option value="" disabled selected hidden>Select
                                                            </option>
                                                            @foreach($student_classes as $class)
                                                                <option
                                                                    value="{{$class->id}}">{{$class->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label for="amount" class="mb-2 pb-1">Fee Amount</label>
                                                        <input type="text" name="amount" id="amount"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               placeholder="0000">
                                                    </div>
                                                    <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light mt-3">
                                                        Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Fee Category</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($feeAmounts as $key=> $amount)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$amount['student_class']['name']}}</td>
                                        <td>{{$amount['fee_category']['name']}}</td>
                                        <td>{{$amount->amount}}</td>
                                        <td>{{ $amount->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm waves-effect waves-light"
                                                        data-toggle="modal" data-animation="bounce"
                                                        data-target="#editClassModal{{ $amount->id }}"><span
                                                        class="ion-edit text-white"></span>
                                                </button>
                                                <a href="{{ route('fee_category_amount.destroy', $amount->id) }}"
                                                   id="delete"
                                                   class="tabledit-delete-button btn btn-lg btn-danger"
                                                   style="float: none; margin:0 5px;"><span
                                                        class="ti-trash text-white"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editClassModal{{ $amount->id }}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="editClassModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('fee_category_amount.update',$amount->id)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group mb-0">
                                                            <label for="category{{$amount->id}}" class="mb-2 pb-1">Select
                                                                Fee Category</label>
                                                            <select required id="category{{$amount->id}}"
                                                                    name="fee_category_id"
                                                                    class="select2 form-control mb-3 custom-select">
                                                                <option value="" disabled selected hidden>Select
                                                                </option>
                                                                @foreach($fee_categories as $category)
                                                                    <option
                                                                        value="{{$category->id}}" {{$amount->fee_category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="class_id{{$amount->id}}" class="mb-2 pb-1">Select
                                                                Class</label>
                                                            <select required id="class_id{{$amount->id}}"
                                                                    name="class_id"
                                                                    class="select2 form-control mb-3 custom-select">
                                                                <option value="" disabled selected hidden>Select
                                                                </option>
                                                                @foreach($student_classes as $class)
                                                                    <option
                                                                        value="{{$class->id}}" {{$amount->class_id == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="amount{{$amount->id}}" class="mb-2 pb-1">Fee
                                                                Amount</label>
                                                            <input type="text" name="amount" id="amount{{$amount->id}}"
                                                                   class="form-control" required=""
                                                                   autocomplete="on" placeholder="0000"
                                                                   value="{{$amount->amount}}">
                                                        </div>
                                                        <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light mt-3">
                                                            Submit
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
