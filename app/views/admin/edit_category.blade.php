@extends('admin.layout')
@section('content')

    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="box-login">
                    {{ Form::open(array('url' => $form_url,'class' => 'form-horizontal','files' =>true)) }}
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                        <div class="col-md-8 col-lg-8 col-sm-12">
                            <div class="tabbable-panel">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        @foreach($category as $index => $cat)
                                            <li class="@if($index == 0) active @endif">
                                                <a href="#{{ $cat->name }}" data-toggle="tab"> {{ $cat->name }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($category as $index => $cat)
                                            <div class="tab-pane @if($index == 0)active @endif" id="{{ $cat->name }}">
                                                <div class="form-group">
                                                    {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $cat->title }}" type="text" name="title[{{ $cat->id }}]" placeholder="Title" class="form-control"/>
                                                        {{ $errors->first('title['. $cat->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="description[{{ $cat->id }}]" class="editor form-control" placeholder="Description" >{{ $cat->description }}</textarea>
                                                        {{ $errors->first('description['. $cat->id .']') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label for="orders" class="col-md-12">
                                    Order
                                </label>
                                <div class="controls">
                                    <input type="text" name="orders" id="orders" class=" form-control" required value="{{ $c->orders }}"/>
                                </div>
                            </div>
                        </div>

                    <!-- Image Section -->
                    <div class="container">
                        <div class="row">
                            <!-- Image Section -->
                            <div class="form-group col-xs-12 col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2 cat-image">
                                <strong>Category Image</strong>
                                <!-- image-preview-filename input [CUT FROM HERE]-->
                                <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                        <!-- image-preview-clear button -->
                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                            <span class="glyphicon glyphicon-remove"></span> Clear
                        </button>
                        <!-- image-preview-input -->
                        <div class="btn btn-default image-preview-input">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <span class="image-preview-input-title">Browse</span>
                            <input type="file" accept="image/png, image/jpeg, image/gif" name="image"/> <!-- rename it -->
                        </div>
                    </span>
                                </div><!-- /input-group image-preview [TO HERE]-->
                            </div>
                        </div>
                    </div>

                    <div style="clear:both"></div>
                    <div class="form-group">
                        <div class="col-sm-3">
                            @if(isset($c->image))
                                <img src="{{url('/')}}/uploads/categories/{{$c->image}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="col-sm-9">&nbsp;</div>
                    </div>
                    <!-- End of Image Section -->

                    <!-- Icon Section -->
                    <div class="container">
                        <div class="row">
                            <!-- Icon Section -->
                            <div class="form-group col-xs-12 col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2 cat-icon">
                                <strong>Category Icon</strong>
                                <!-- image-preview-filename input [CUT FROM HERE]-->
                                <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                        <!-- image-preview-clear button -->
                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                            <span class="glyphicon glyphicon-remove"></span> Clear
                        </button>
                        <!-- image-preview-input -->
                        <div class="btn btn-default image-preview-input">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <span class="image-preview-input-title">Browse</span>
                            <input type="file" accept="image/png, image/jpeg, image/gif" name="icon"/> <!-- rename it -->
                        </div>
                    </span>
                                </div><!-- /input-group image-preview [TO HERE]-->
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>

                    <div class="form-group">
                        <div class="col-sm-3">
                            @if(isset($c->icon))
                                <img src="{{url('/')}}/uploads/categories/{{$c->icon}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="col-sm-9">&nbsp;</div>
                    </div>
                    <!-- End of Icon Section -->

                    <!-- ProIcon Section -->
                    <div class="container">
                        <div class="row">
                            <!-- Icon Section -->
                            <div class="form-group col-xs-12 col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2 pro-icon">
                                <strong>Product Icon</strong>
                                <!-- image-preview-filename input [CUT FROM HERE]-->
                                <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="proicon"/> <!-- rename it -->
                                </div>
                            </span>
                                </div><!-- /input-group image-preview [TO HERE]-->
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>


                    <div class="form-group">
                        <div class="col-sm-3">
                            @if(isset($c->proicon))
                                <img src="{{url('/')}}/uploads/categories/{{$c->proicon}}" class="img-responsive">
                            @endif
                        </div>
                        <div class="col-sm-9">&nbsp;</div>
                    </div>
                    <!-- End of Icon Section -->

                    <div class="form-actions">
                        {{ Form::submit('Save', $attributes = ['class' => 'btn btn-primary pull-left']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop