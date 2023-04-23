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
                                <li class="breadcrumb-item"><a href="{{route('employee.all')}}">Employee
                                        Management</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee.create')}}">Employee
                                        Registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Employee Salary Management</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">


                                <div class="col-md-6">

                                    <div class="form-group">
                                        <h5>Attendace Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" id="date" class="form-control">
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-6" style="padding-top: 25px;">

                                    <a id="search" class="btn text-white mt-3 btn-primary" name="search"> Search</a>

                                </div> <!-- End Col md 6 -->
                            </div>
                            <div id="DocumentResults">
                                <script id="document-template" type="text/x-handlebars-template">
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            @{{{thsource}}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                        </tbody>
                                    </table>

                                </script>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).on('click', '#search', function () {
            var date = $('#date').val();
            $.ajax({
                url: "{{ route('employee.monthly.salary.get')}}",
                type: "get",
                data: {'date': date},
                beforeSend: function () {
                },
                success: function (data) {
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });

    </script>
@endsection
