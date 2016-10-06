@extends('admin.layout')

@section('content')

<div class="col-md-6 col-lg-8 col-sm-6">
    <div class="card">
        <div class="card-body">
            <div class="box-login">
                {{ Form::open(array('route' => 'save_add_page','class' => 'form-horizontal','files' =>true)) }}

                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            @foreach($languages as $index => $language)
                                <li class="@if($index == 0) active @endif">
                                    <a href="#{{ $language->name }}" data-toggle="tab"> {{ $language->name }} </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($languages as $index => $language)
                                <div class="tab-pane @if($index == 0)active @endif" id="{{ $language->name }}">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}

                                        <div class="col-sm-9">
                                            <input type="text" name="title[{{ $language->code }}]" placeholder="Title" class="form-control"/>
                                            {{ $errors->first('title['. $language->code .']') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}

                                        <div class="col-sm-9">
                                            <textarea name="description[{{ $language->code }}]" class="editor form-control" placeholder="Description" ></textarea>
                                            {{ $errors->first('description['. $language->code .']') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    {{ Form::submit('Save', $attributes = ['class' => 'btn btn-green pull-right']) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop