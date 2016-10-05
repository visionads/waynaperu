@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	
    <!-- start: PAGE CONTENT -->
            <div class="row">
                <div class="col-md-6 col-lg-8 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="box-login">
                                {{ Form::open(array('url' => $action, 'class' => 'form-horizontal','files' =>true)) }}

                                @if(Session::has('message'))
                                    <div class="alert alert-info">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif

                                <fieldset>
                                    <div class="form-group">
                                        {{ Form::label('language','Language File :', $attributes = ['class' => 'col-sm-3 control-label']) }}
                                        <div class="col-sm-9">
                                            {{ Form::textarea('language',$lang_data, $attributes = ['class' => 'form-control', 'rows' => '50', 'cols' => '12']) }}
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        {{ Form::submit('Update', $attributes = ['class' => 'btn btn-green pull-right']) }}
                                    </div>
                                </fieldset>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: PAGE CONTENT-->
</div>

@stop
