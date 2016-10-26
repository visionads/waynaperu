<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exploor.pe - Login</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->

    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link href="{{ asset('assets/admin/css/theme-default/bootstrap.css?1422792965') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/theme-default/materialadmin.css?1425466319') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/theme-default/font-awesome.min.css?1422529194') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" rel="stylesheet">
    <!-- END STYLESHEETS -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script type="text/javascript" src="../../assets/js/libs/utils/html5shiv.js?1403934957"></script>
    <script type="text/javascript" src="../../assets/js/libs/utils/respond.min.js?1403934956"></script>-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/libs/utils/html5shiv.js?1403934957') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/libs/utils/respond.min.js?1403934956') }}"></script>
    <![endif]-->
</head>
<body class="menubar-hoverable header-fixed ">

<!-- BEGIN LOGIN SECTION -->
<section class="section-account">
    {{--<div class="img-backdrop" style="background-image:url('../assets/admin/img/img16.jpg')"></div>--}}
    {{--<div class="spacer"></div>--}}
    <div class="card contain-sm style-transparent">
        <div class="card-body">
            <div class="row">
                @include('admin.theme.errormessage')
                <div class="col-sm-6">

                    <br/>
                    <span class="text-lg text-bold text-primary">Exploor.pe</span>
                    <br/><br/>
                    <div class="card">
                        <div class="card-body">
                            <form class="form floating-label" action="{{ url('admin_login') }}" accept-charset="utf-8" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="{{ trans('usermanager::all.email') }}" name="email" id="email">
                                    <label for="username">Email</label>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="{{ trans('usermanager::all.password') }}" name="password" id="pass">
                                    <label for="password">Password</label>
                                    <p class="help-block"><a href="#">Forgotten?</a></p>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <div class="checkbox checkbox-inline checkbox-styled">
                                            <label>
                                                <input type="checkbox"> <span>Remember me</span>
                                            </label>
                                            {{--<label class="checkbox primary">
                                                <input type="checkbox" data-toggle="switch" id="remember" name="remember" value="false" data-on-text="<span class='fui-check'></span>" data-off-text="<span class='fui-cross'></span>" />
                                                {{ trans('usermanager::all.remember') }}
                                            </label>--}}
                                        </div>
                                    </div><!--end .col -->
                                    <div class="col-xs-6 text-right">
                                        <button class="btn btn-primary btn-raised" type="submit">{{ trans('usermanager::all.signin') }}</button>
                                    </div><!--end .col -->
                                </div><!--end .row -->
                            </form>
                        </div>
                    </div>
                </div><!--end .col -->
                <div class="col-sm-5 col-sm-offset-1 text-center">
                    <br><br>
                    <h3 class="text-light">
                        No account yet?
                    </h3>
                    <a class="btn btn-block btn-raised btn-primary" href="#">Sign up here</a>
                    <br><br>
                    <h3 class="text-light">
                        or
                    </h3>
                    <p>
                        <a href="#" class="btn btn-block btn-raised btn-info"><i class="fa fa-facebook pull-left"></i>Login with Facebook</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-block btn-raised btn-info"><i class="fa fa-twitter pull-left"></i>Login with Twitter</a>
                    </p>
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card-body -->
    </div><!--end .card -->
</section>
<!-- END LOGIN SECTION -->

<!-- BEGIN JAVASCRIPT -->
<script src="{{ asset('assets/admin/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/spin.js/spin.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/autosize/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/flot/curvedLines.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/d3/d3.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/libs/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/App.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppNavigation.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppOffcanvas.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppCard.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppForm.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppNavSearch.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/source/AppVendor.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/demo/Demo.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/demo/DemoDashboard.js') }}"></script>
        <!-- END JAVASCRIPT -->

</body>
</html>
