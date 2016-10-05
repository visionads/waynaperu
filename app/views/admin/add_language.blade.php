@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-8 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="box-login">
                    {{ Form::open(array('url' => $form_url,'class' => 'form-horizontal','files' =>true)) }}

                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if(isset($language))
                        {{Form::hidden('id',$language->id) }}
                    @endif
                    <fieldset>
                        <br>
                        <br>
                        <br>
                        <div class="form-group">
                            {{ Form::label('name','Name :', $attributes = ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::text('name', isset($language) ? $language->name : '', $attributes = ['class' => 'form-control', 'placeholder' => 'Language Name','required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('code','Language Code :', $attributes = ['class' => 'col-sm-3 control-label']) }}
                            <div class="col-sm-9">
                                {{ Form::text('code', isset($language) ? $language->code : '', $attributes = ['class' => 'form-control', 'placeholder' => 'Language Code','required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('flag','Flag', $attributes = ['class' => 'col-sm-3 control-label']) }}

                            <div class="col-sm-9">
                                {{ Form::file('flag', '', $attributes = ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">&nbsp;</div>
                            <div class="col-sm-9">
                                @if(isset($language))
                                    <img src="{{url('/')}}/uploads/flags/{{$language->flag}}">
                                @endif
                            </div>
                        </div>

                        <div class="form-actions">
                            @if(isset($language))
                                {{ Form::submit('Update', $attributes = ['class' => 'btn btn-green pull-right']) }}
                            @else
                                {{ Form::submit('Add', $attributes = ['class' => 'btn btn-green pull-right']) }}
                            @endif
                        </div>
                    </fieldset>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop