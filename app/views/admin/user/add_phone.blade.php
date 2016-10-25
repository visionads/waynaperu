@extends('admin.layout')
@section('content')

        <div class="col-md-6 col-lg-8 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="box-login">
                        {{ Form::open(array('url' => 'user/store_phone_number/'.$user->id,'class' => 'form-horizontal','files' =>true)) }}

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    <li class="active">
                                        <a href="#" data-toggle="tab"> {{ trans('provider.add_new_phone_number_for') }} <b>{{ $user->first_name.' '.$user->last_name }}</b> </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active " id="">
                                        @include('admin.user._formPhone')
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

@stop