@extends('admin.layout')
@section('content')

        <div class="col-md-6 col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::model($bank,array('url' => 'user/update_bank/'.$bank->id,'class' => 'form-horizontal','files' =>true)) }}

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#" data-toggle="tab"> Edit bank account for <b>{{ $user->first_name.' '.$user->last_name }}</b> </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active " id="">
                                        @include('admin.user._formBank')
                                    </div>
                                </div>
                            </div>
                        </div>

                            {{ Form::submit('Update', $attributes = ['class' => 'btn btn-green']) }}
                        <div class="form-actions pull-right">
                        <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

@stop