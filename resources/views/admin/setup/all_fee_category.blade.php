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
                                <li class="breadcrumb-item"><a href="{{route('fee_category.all')}}">Fee Categories</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Fee Category Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">All Fee Category</h4>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-animation="bounce"
                                        data-target=".bs-example-modal-center">Add Fee Category
                                </button>
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                     aria-labelledby="mySmallModalLabel" style="display: none;"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Fee Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('fee_category.store')}}" method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <div class="form-group mb-0">
                                                        <label for="class_name" class="mb-2 pb-1">Fee Category
                                                            Name</label>
                                                        <input type="text" name="name" id="class_name"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               list="class_name"
                                                               placeholder="Registration fee">
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
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($feeCategories as $key=> $fees)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$fees->name}}</td>
                                        <td>{{ $fees->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm waves-effect waves-light"
                                                        data-toggle="modal" data-animation="bounce"
                                                        data-target="#editClassModal{{ $fees->id }}"><span
                                                        class="ion-edit text-white"></span>
                                                </button>
                                                <a href="{{ route('fee_category.destroy', $fees->id) }}" id="delete"
                                                   class="tabledit-delete-button btn btn-lg btn-danger"
                                                   style="float: none; margin:0 5px;"><span
                                                        class="ti-trash text-white"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editClassModal{{ $fees->id }}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="editClassModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editClassModalLabel">Edit Fee
                                                        Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('fee_category.update', $fees->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="className">Class Name</label>
                                                            <input type="text" class="form-control" id="className"
                                                                   name="name" value="{{ $fees->name }}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update Fee
                                                            Category
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
