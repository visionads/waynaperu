@extends('admin.layout')
@section('content')
        <div class="col-md-6 col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::model($user,array('url' => 'user/update_profile/'.$user->id,'class' => 'form-horizontal','files' =>true)) }}

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#" data-toggle="tab"> Edit Profile of <b> {{ $user->first_name.' '.$user->last_name }}</b></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active " id="">
                                        @include('admin.user._formProfile')
                                    </div>
                                </div>
                            </div>
                        </div>

                            &nbsp;&nbsp;<a href="{{ URL::previous() }}" class="btn btn-info pull-left">Back</a>
                        <div class="form-actions pull-right">
                            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
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
                    password:'<div style="margin-top: 20px; color:red;">Password Required</div>',
                    c_password:'<div style="margin-top: 20px; color:red;">Password not matched. Type again</div>'
                }
            });
        </script>

@stop