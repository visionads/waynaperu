@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-8 col-sm-6">
        <div class="box-login">
           
            {{ Form::open(array('url' => $form_url,'class' => 'form-horizontal','files' =>true)) }}

            @if(Session::has('message'))
            <div class="alert alert-info">
                {{ Session::get('message') }}
            </div>
            @endif
           
            <fieldset class="col-md-12 col-lg-12 col-sm-12">
            <br>
            <br>
            <br>
                        <div class="form-group">
                                    {{ Form::label('name', 'District Name', array('class' => 'col-sm-3 control-label')) }}
                                    
                                    <div class="col-sm-9">
                                         <input type="text" name="name" placeholder="District Name" class="form-control" required value="{{ $district->name }}"/>
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>

            

                
            </fieldset>
            

           

            <div class="form-actions">
                {{ Form::submit('Save', $attributes = ['class' => 'btn btn-primary pull-left']) }}
                    
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
@stop