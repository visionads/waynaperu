@extends('admin.layout')
@section('content')

        {{--<div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::model($user,array('url' => 'user/update/'.$user->id,'class' => 'form-horizontal','files' =>true, 'id'=>'chkpass')) }}
                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                            <div class="col-md-8 col-lg-8 col-sm-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Edit User</div>
                                    <div class="panel-body">
                                        @include('admin.user._form')

                                        <div class="form-actions">
                                            {{ Form::submit('Update', $attributes = ['class' => 'btn btn-primary pull-left']) }}
                                            &nbsp;&nbsp;
                                            <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>--}}



        <div class="col-md-6 col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::model($user,array('url' => 'user/update/'.$user->id,'class' => 'form-horizontal','files' =>true, 'id'=>'chkpass')) }}

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#" data-toggle="tab"> {{ trans('provider.edit_user') }} </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active " id="">
                                        @include('admin.user._form')
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions pull-right">
                            &nbsp;&nbsp;<a href="{{ URL::previous() }}" class="btn btn-info">{{ trans('provider.back') }}</a>
                            {{ Form::submit(trans('provider.save'), $attributes = ['class' => 'btn btn-green']) }}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>


        <script>
            jQuery.validator.setDefaults({
                debug: true,
                success: "valid"
            });
            $( "#chkpass" ).validate({
                rules: {
                    password: "required",
                    c_password: {
                        equalTo: "#password"
                    }
                },
                messages:
                {
                    password:'<div style="margin-top: 20px; color:red;">{{ trans('provider.password_required') }}}</div>',
                    c_password:'<div style="margin-top: 20px; color:red;">{{ trans('provider.password_not_matched_type_again') }}}</div>'
                }
            });
        </script>

@stop