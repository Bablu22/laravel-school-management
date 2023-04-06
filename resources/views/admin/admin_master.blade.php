<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>School - Complete school management system</title>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="Bablu Mia" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    {{-- DataTables & Responsive datatable examples --}}
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Dropzone css -->
    <link href="{{asset('assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
    {{-- Modal animation --}}
    <link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/plugins/fullcalendar/vanillaCalendar.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/morris/morris.css')}}" rel="stylesheet">
    {{-- Form advance --}}
    <link href="{{asset('assets/plugins/timepicker/tempusdominus-bootstrap-4.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/clockpicker/jquery-clockpicker.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/plugins/colorpicker/asColorPicker.min.css" rel="stylesheet')}}" type="text/css"/>
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}"
          rel="stylesheet"/>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
            <i class="ion-close"></i>
        </button>

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{route('dashboard')}}" class="logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-large">
                </a>
            </div>
        </div>
        @include('admin.body.sidebar')
    </div>

    <!-- Start right Content here -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            @include('admin.body.header')
            @yield('admin')
        </div>
        <footer class="footer">
            © <?php echo date('Y'); ?> Developed by Bablu Mia.
        </footer>
    </div>
</div>


<!-- jQuery  -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.min.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('assets/js/waves.js')}}"></script>
<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/plugins/skycons/skycons.min.js')}}"></script>
<script src="{{asset('assets/plugins/fullcalendar/vanillaCalendar.js')}}"></script>
<script src="{{asset('assets/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
{{--<script src="{{asset('assets/pages/dashborad.js')}}"></script>--}}


<!-- Required datatable js -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.j')}}s"></script>

<!-- Parsley js for form validation -->
<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Sweet-Alert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Dropzone js -->
<script src="{{asset('assets/plugins/dropzone/dist/dropzone.js')}}"></script>
<script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>


{{--Form advance--}}
<script src="{{asset('assets/plugins/timepicker/moment.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/tempusdominus-bootstrap-4.js')}}"></script>
<script src="{{asset('assets/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{asset('assets/plugins/clockpicker/jquery-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/colorpicker/jquery-asColor.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/colorpicker/jquery-asGradient.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/colorpicker/jquery-asColorPicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"
        type="text/javascript"></script>


<!-- Plugins Init js -->
<script src="{{asset('assets/pages/form-advanced.js')}}"></script>
<script src="{{asset('assets/pages/datatables.init.js')}}"></script>
<script src="{{asset('assets/pages/modal-animation.init.js')}}"></script>
<script src="{{asset('assets/pages/upload.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>


<script>
    $(document).ready(function () {
        $('form').parsley();
    });
    $(document).ready(function () {
        $('#datatable2').DataTable();
    });
    $(document).ready(function () {
        const generatePasswordBtn = $('#generate-password-btn');
        const passwordInput = $('#password');
        generatePasswordBtn.on('click', function () {
            passwordInput.val('{{ Str::random(8) }}');
        });
    });

</script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    });
</script>
<script>
    $('#myModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const classId = button.data('classid'); // Extract info from data-* attributes
        const className = button.data('classname');
        const modal = $(this);

        // Populate the form fields with the relevant data
        modal.find('.modal-body #class-id').val(classId);
        modal.find('.modal-body #class-name').val(className);
    });
</script>
</body>
</html>
