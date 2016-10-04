@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box-login">
                {{ Form::model($user,array('url' => 'user/update/'.$user->id,'class' => 'form-horizontal','files' =>true)) }}
                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <fieldset class="col-md-12 col-lg-12 col-sm-12">
                    <br>
                    <br>
                    <br>

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

                </fieldset>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop