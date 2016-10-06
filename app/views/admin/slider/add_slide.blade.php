@extends('admin.layout')
@section('content')

    <div class="col-md-6 col-lg-8 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="box-login">
                    {{ Form::open(array('route' => 'store_slide','class' => 'form-horizontal','files' =>true)) }}
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        @include('admin.slider._form')
                                <!-- Image Section -->
                        <div class="container">
                            <div class="row">
                                <!-- Image Section -->
                                <div class="form-group col-xs-12 col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2 cat-image">
                                    <strong>Slider Image</strong>
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
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="path" required/> <!-- rename it -->
                                    {{--<input type="file" name="path"/> <!-- rename it -->--}}
                                </div>
                            </span>
                                    </div><!-- /input-group image-preview [TO HERE]-->
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="col-sm-3">&nbsp;</div>
                            <div class="col-sm-9">
                                @if(isset($category))
                                    <img src="{{url('/')}}/uploads/categories/{{$language->flag}}">
                                @endif
                            </div>
                        </div> --}}
                                <!-- End of Image Section -->

                        <div class="form-actions">
                            {{ Form::submit('Save', $attributes = ['class' => 'btn btn-primary pull-left']) }}
                            &nbsp;
                            <a href="{{ url('admin/slider') }}" class="btn btn-info">Cancel</a>
                        </div>

                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@stop