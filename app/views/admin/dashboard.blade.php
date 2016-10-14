@extends('admin.layout')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-head">
                <header><i class="fa fa-dashboard">&nbsp;</i> Dashboard</header>
                <div class="tools">
                    {{--<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>--}}
                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                    <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                </div>
            </div><!--end .card-head -->
            <div class="card-body no-padding height-9">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="force-padding pull-right text-default-light">
                            <div class="no-margin text-primary-dark text-center">Waynaperu Dashboard</div>
                        </div>
                    </div><!--end .col -->
                </div><!--end .row -->
                {{--<div class="stick-bottom-left-right force-padding">
                    <div id="flot-registrations" class="flot height-5" data-title="Registration history" data-color="#0aa89e"></div>
                </div>--}}
            </div>
        </div>
    </div>



@stop
