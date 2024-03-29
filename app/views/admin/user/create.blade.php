@extends('admin.layout')
@section('content')

        <div class="col-md-6 col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::open(array('url' => 'user/store','class' => 'form-horizontal','files' =>true)) }}

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#" data-toggle="tab"> Add New User </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active " id="">
                                        @include('admin.user._form')
                                        {{--<div class="form-actions">
                                            {{ Form::submit('Save', $attributes = ['class' => 'btn btn-primary pull-left']) }}
                                            &nbsp;&nbsp;
                                            <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions pull-right">
                            &nbsp;&nbsp;<a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                            {{ Form::submit('Save', $attributes = ['class' => 'btn btn-green']) }}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

@stop