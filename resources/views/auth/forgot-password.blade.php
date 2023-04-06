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
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">

            <div class="text-center">
                <a href="/" class="logo logo-admin"><img src="{{asset('assets/images/logo.png')}}" height="20"
                                                         alt="logo"></a>
            </div>

            <div class="p-3">
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">

                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Enter your <b>Email</b> and instructions will be sent to you!
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="email"></label>
                            <input class="form-control" id="email" name="email" value="{{old('email')}}" type="email"
                                   required=""
                                   placeholder="Email">

                        </div>
                    </div>

                    <div class="form-group text-center row m-t-20">
                        <div class="col-12">
                            <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Send Email
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
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
<!-- App js -->
<script src="{{asset('assets/js/app.js')}}"></script>

</body>
</html>
