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
<body>


<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">

            <div class="text-center">
                <a href="/" class="logo logo-admin"><img
                        src="{{asset('assets/images/logo.png')}}" height="20"
                        alt="logo"></a>
            </div>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>{{$error}}</strong>
                </div>
            @endforeach
            <div class="px-3 pb-3">
                <form class="form-horizontal m-t-20" action="{{route('login')}}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="email">Enter email</label>
                            <input class="form-control" id="email" value="{{old('email')}}" name="email" type="email"
                                   required=""
                                   placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <label for="password">Enter password</label>
                            <input class="form-control" id="password" name="password" value="{{old('passwprd')}}"
                                   type="password" required=""
                                   placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                <label class="custom-control-label" for="remember_me">Remember me</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center row m-t-20">
                        <div class="col-12">
                            <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-sm-7 m-t-20">
                            @if (Route::has('password.request'))
                                <a href="{{route('password.request')}}" class="text-muted"><i class="mdi mdi-lock"></i>
                                    <small>Forgot
                                        your password ?</small></a>
                            @endif
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
