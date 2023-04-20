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
                                <li class="breadcrumb-item"><a href="{{route('subject-assign.all')}}">Assign
                                        Subject</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Assign Subject Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="mt-0 header-title">Assign Subject</h4>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-animation="bounce"
                                        data-target=".bs-example-modal-center">Assign Subject
                                </button>
                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                     aria-labelledby="mySmallModalLabel" style="display: none;"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Assign Subject</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('subject-assign.store')}}" method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <div class="form-group mb-0">
                                                        <label for="category" class="mb-2 pb-1">Select Subject</label>
                                                        <select required id="category" name="subject_id"
                                                                class="select2 form-control mb-3 custom-select">
                                                            <option value="" disabled selected hidden>Select
                                                            </option>
                                                            @foreach($subjects as $subject)
                                                                <option
                                                                    value="{{$subject->id}}">{{$subject->name}}</option>
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
                                                        <label for="full_mark" class="mb-2 pb-1">Full Mark</label>
                                                        <input type="text" name="full_mark" id="full_mark"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               placeholder="0000">
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="pass_mark" class="mb-2 pb-1">Pass Mark</label>
                                                        <input type="text" name="pass_mark" id="pass_mark"
                                                               class="form-control"
                                                               required=""
                                                               autocomplete="on"
                                                               placeholder="0000">
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="subjective_mark" class="mb-2 pb-1">Subjective
                                                            Mark</label>
                                                        <input type="text" name="subjective_mark" id="subjective_mark"
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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allData as $key=> $amount)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$amount['studentClass']['name']}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <a href="{{ route('subject-assign.details', $amount->class_id) }}"
                                                   class="btn btn-lg btn-info"
                                                   style="float: none; margin:0 5px;">Details
                                                </a>
                                            </div>
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
