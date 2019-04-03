
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>GoFun CRM</title>
    <meta name="description" content="GoFun CRM" />
    <meta name="keywords" content="GoFun CRM" />
    <meta name="author" content="GoFun CRM"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="{{asset('assets/vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Custom CSS -->
    <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper pa-0">
    <header class="sp-header">
        <div class="sp-logo-wrap pull-left">
            <a href="index.html">
                <img class="brand-img mr-10" style="width:30px ; height:30px ; border-radius:50%" src="{{asset('assets/dist/img/gofun.png')}}" alt="brand"/>
                <span class="brand-text">Go Fun CRM</span>
            </a>
        </div>
        <div class="clearfix"></div>
    </header>

    <!-- Main Content -->
    <div class="page-wrapper pa-0 ma-0 auth-page">
        <div class="container-fluid">
            <!-- Row -->
            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle auth-form-wrap">
                    <div class="auth-form  ml-auto mr-auto no-float">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10">Login Here</h3>
                                    <h6 class="text-center nonecase-font txt-grey">Enter your credentials here</h6>
                                </div>
                                <div class="form-wrap">
                                    <form  method="POST" action="{{ route('login')}}">
                                        @csrf
                                            <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
                                                <input type="email" class="form-control" name="email" id="exampleInputEmail_2"  placeholder="Enter email">
                                                @if ($errors->has('email'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label>

                                                <div class="clearfix"></div>
                                                <input type="password" class="form-control" name="password"  id="exampleInputpwd_2" placeholder="Enter password">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-success btn-rounded btn-block">sign in</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="{{asset('assets/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{asset('assets/dist/js/jquery.slimscroll.js')}}"></script>

<!-- Init JavaScript -->
<script src="{{asset('assets/dist/js/init.js')}}"></script>
</body>
</html>

