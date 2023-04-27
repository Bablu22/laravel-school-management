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
                                <li class="breadcrumb-item"><a href="{{route('student-registration.all')}}">Student
                                        Registration</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Student Registration</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row mt-3">

                                <div class="form-group mb-0 col-lg-3">
                                    <label for="start_date" class="mb-2 pb-1">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                           required=""
                                           placeholder="Type address">
                                </div>

                                <div class="form-group mb-0 col-lg-3">
                                    <label for="end_date" class="mb-2 pb-1">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                           required=""
                                           placeholder="Type address">
                                </div>
                            </div>
                            <div class="form-group mt-3 mb-0">
                                <a id="search" class="btn text-white btn-primary" name="search"> Search</a>
                            </div>

                            <div class="row mt-3" id="">
                                <div class="col-md-12">
                                    <div id="DocumentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                <tr>
                                                    @{{{thsource}}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    @{{{tdsource}}}
                                                </tr>
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
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '#search', function () {
            const start_date = $('#start_date').val();
            const end_date = $('#end_date').val();
            $.ajax({
                url: "{{ route('report.profit.datewais.get')}}",
                type: "get",
                data: {'start_date': start_date, 'end_date': end_date},
                beforeSend: function () {
                },
                success: function (data) {
                    const source = $("#document-template").html();
                    const template = Handlebars.compile(source);
                    const html = template(data);
                    // empty the content of the table before adding new data
                    $('#DocumentResults').empty().append(html);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
    </script>

@endsection
