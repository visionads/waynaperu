@extends('admin.layout')
@section('content')
{{--<div class="row">--}}
    <div class="col-md-6 col-lg-8 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="box-login">
                    {{ Form::model($slide,array('route' => 'update_slide','class' => 'form-horizontal','files' =>true)) }}
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        {{ Form::hidden('id',$slide->id) }}

                        @include('admin.slider._form')
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
                            {{ Form::submit('Update', $attributes = ['class' => 'btn btn-primary pull-left']) }}&nbsp;
                            <a href="{{ url('admin/slider') }}" class="btn btn-info">Cancel</a>
                        </div>

                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
{{--</div>--}}
@stop