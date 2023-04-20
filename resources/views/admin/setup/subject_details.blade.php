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
                                <h4 class="mt-0 header-title">Assign Subject details
                                </h4>
                            </div>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Full Mark</th>
                                    <th>Pass Mark</th>
                                    <th>subjective Mark</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($detailsData as $key=> $data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data['studentClass']['name']}}</td>
                                        <td>{{$data['subject']['name']}}</td>
                                        <td>{{$data->full_mark}}</td>
                                        <td>{{$data->pass_mark}}</td>
                                        <td>{{$data->subjective_mark}}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-primary btn-sm waves-effect waves-light"
                                                    data-toggle="modal" data-animation="bounce"
                                                    data-target="#editClassModal{{ $data->id }}"><span
                                                    class="ion-edit text-white"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editClassModal{{ $data->id }}" tabindex="-1"
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
                                                    <form action="{{route('subject-assign.update',$data->class_id)}}"
                                                          method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group mb-0">
                                                            <label for="category{{$data->class_id}}"
                                                                   class="mb-2 pb-1">Select
                                                                Fee Category</label>
                                                            <select required id="category{{$data->class_id}}"
                                                                    name="subject_id"
                                                                    class="select2 form-control mb-3 custom-select">
                                                                <option value="" disabled selected hidden>Select
                                                                </option>
                                                                @foreach($subjects as $subject)
                                                                    <option
                                                                        value="{{$subject->id}}" {{$data->subject_id == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="class_id{{$data->class_id}}"
                                                                   class="mb-2 pb-1">Select
                                                                Class</label>
                                                            <select required id="class_id{{$data->class_id}}"
                                                                    name="class_id"
                                                                    class="select2 form-control mb-3 custom-select">
                                                                <option value="" disabled selected hidden>Select
                                                                </option>
                                                                @foreach($student_classes as $class)
                                                                    <option
                                                                        value="{{$class->id}}" {{$data->class_id == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="full_mark" class="mb-2 pb-1">Full Mark</label>
                                                            <input type="text" name="full_mark" id="full_mark"
                                                                   class="form-control"
                                                                   required=""
                                                                   value="{{$data->full_mark}}"
                                                                   autocomplete="on"
                                                                   placeholder="0000">
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="pass_mark" class="mb-2 pb-1">Pass Mark</label>
                                                            <input type="text" name="pass_mark" id="pass_mark"
                                                                   class="form-control"
                                                                   required=""
                                                                   value="{{$data->pass_mark}}"
                                                                   autocomplete="on"
                                                                   placeholder="0000">
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="subjective_mark" class="mb-2 pb-1">Subjective
                                                                Mark</label>
                                                            <input type="text" name="subjective_mark"
                                                                   id="subjective_mark"
                                                                   class="form-control"
                                                                   required=""
                                                                   value="{{$data->subjective_mark}}"
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
