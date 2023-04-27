@extends('admin.admin_master')
@section('admin')
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('account.others.view')}}">Other cost</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Account other cost Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">All costs Amounts</h4>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-animation="bounce"
                                        data-target=".bs-example-modal-center">Add Cost
                                </button>
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                     aria-labelledby="mySmallModalLabel" style="display: none;"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add cost Amount</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('account.others.store')}}" method="POST">
                                                    @csrf
                                                    @method('post')

                                                    <div class="form-group mt-3">
                                                        <label for="description" class="mb-2 pb-1">Description</label>
                                                        <input type="text" name="description" id="description"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               placeholder="Type...">
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="amount" class="mb-2 pb-1">Amount</label>
                                                        <input type="text" name="amount" id="amount"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               placeholder="0000">
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="mdate" class="mb-2 pb-1">Date</label>
                                                        <input type="date" class="form-control" id="mdate" name="date"
                                                               required=""
                                                               placeholder="Type address">
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
                                    <th width="5%">SL</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allData as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ date('d-m-Y', strtotime($value->date)) }}</td>
                                        <td> {{ $value->amount }}</td>
                                        <td> {{ $value->description }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <button type="button"
                                                        class="btn btn-primary btn-sm waves-effect waves-light"
                                                        data-toggle="modal" data-animation="bounce"
                                                        data-target="#editClassModal{{ $value->id }}"><span
                                                        class="ion-edit text-white"></span>
                                                </button>
                                                <a href="{{ route('account.others.delete', $value->id) }}"
                                                   id="delete"
                                                   class="tabledit-delete-button btn btn-lg btn-danger"
                                                   style="float: none; margin:0 5px;"><span
                                                        class="ti-trash text-white"></span>
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
                                                    <h5 class="modal-title" id="editClassModalLabel">Edit Cost</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('account.others.update',$value->id)}}"
                                                          method="POST">
                                                        @csrf

                                                        <div class="form-group mt-3">
                                                            <label for="amount{{$value->id}}" class="mb-2 pb-1">
                                                                Description</label>
                                                            <input type="text" name="description"
                                                                   id="amount{{$value->id}}"
                                                                   class="form-control" required=""
                                                                   autocomplete="on" placeholder="Type..."
                                                                   value="{{$value->description}}">
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="amount{{$value->id}}" class="mb-2 pb-1">
                                                                Amount</label>
                                                            <input type="text" name="amount" id="amount{{$value->id}}"
                                                                   class="form-control" required=""
                                                                   autocomplete="on" placeholder="0000"
                                                                   value="{{$value->amount}}">
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="mdate" class="mb-2 pb-1">Date</label>
                                                            <input type="date" class="form-control" id="mdate"
                                                                   name="date"
                                                                   required=""
                                                                   value="{{$value->date}}"
                                                                   placeholder="Type address">
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
