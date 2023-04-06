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
