@extends('admin.layout')

@section('content')

<div class="col-md-6 col-lg-8 col-sm-6">
    <div class="card">
        <div class="card-body">
            <div class="box-login">

                {{ Form::open(array('route' => array('save_edit_page', $page_id),'class' => 'form-horizontal','files' =>true)) }}

                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            @foreach($content as $index => $data)
                                <li class="@if($index == 0) active @endif">
                                    <a href="#{{ $data->name }}" data-toggle="tab"> {{ $data->name }} </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($content as $index => $data)
                                <div class="tab-pane @if($index == 0)active @endif" id="{{ $data->name }}">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}

                                        <div class="col-sm-9">
                                            <input type="text" name="title[{{ $data->id }}]" placeholder="Title" class="form-control" value="{{ $data->title }}"/>
                                            {{ $errors->first('title['. $data->id .']') }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}

                                        <div class="col-sm-9">
                                            <textarea name="description[{{ $data->id }}]" class="editor form-control" placeholder="Description" >{{ $data->description }}</textarea>
                                            {{ $errors->first('description['. $data->id .']') }}
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