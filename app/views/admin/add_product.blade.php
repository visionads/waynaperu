@extends('admin.layout')



@section('content')



<div class="row">

    <div class="col-md-12 col-lg-12 col-sm-12">

        <div class="box-login">

           

            {{ Form::open(array('url' => $form_url,'class' => 'form-horizontal','files' =>true)) }}



            @if(Session::has('message'))

            <div class="alert alert-info">

                {{ Session::get('message') }}

            </div>

            @endif

            <fieldset>

            <br><br><br>

            <div class="col-md-8 col-lg-8 col-sm-12">

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

                                         <input type="text" name="title[{{ $language->code }}]" placeholder="Title" class="form-control" required/>

                                        {{ $errors->first('title['. $language->code .']') }}

                                    </div>

                                </div>

                                <div class="form-group">

                                    {{ Form::label('mini_description', 'Mini Description', array('class' => 'col-sm-3 control-label')) }}

                                    

                                    <div class="col-sm-9">

                                        <textarea name="mini_description[{{ $language->code }}]" class="form-control" placeholder="Mini Description" ></textarea>

                                        {{ $errors->first('mini_description['. $language->code .']') }}

                                       

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

            </div>

            <div class="col-md-4 col-lg-4 col-sm-12">

                    <div class="form-group">

                    <label for="category" class="col-md-12"> 

                        Category

                    </label>

                    <div class="controls">

                        <select name="category" id="category" class=" form-control" required>

                            <option value="">-Select A Category-</option>

                            @foreach($category as $index => $cat)

                             <option value="{{ $cat->cat_id }}">{{ $cat->title }}</option>

                            @endforeach

                            

                        </select>

                    </div>

                </div>

                 <div class="form-group">

                    <label for="first_loc_id" class="col-md-12"> 

                        Enter Tags for Experience

                    </label>

                    <div class="controls">

                       <input type="text" name="tags" class="form-control"

                   value="" data-role="tagsinput" />

                    </div>

                </div>
                <div class="btn-group to_whom" data-toggle="buttons">
                    
                    <div class="col-md-12">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="is_lead" value="1" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Check If Product is a Lead.
                    </div>    
                    
            
                </div>
                <div class="form-group">

                    <label for="lead_email" class="col-md-12"> 

                        Enter Email for Lead Experience

                    </label>

                    <div class="controls">

                       <input type="text" name="lead_email" class="form-control"

                   value=""/>

                    </div>

                </div>
                <div class="form-group">

                    <label for="lead_name" class="col-md-12"> 

                        Enter Name for Lead Experience

                    </label>

                    <div class="controls">

                       <input type="text" name="lead_name" class="form-control"

                   value=""/>

                    </div>

                </div>
                <div class="form-group">

                    <label for="lead_phone" class="col-md-12"> 

                        Enter Phone for Lead Experience

                    </label>

                    <div class="controls">

                       <input type="text" name="lead_phone" class="form-control"

                   value=""/>

                    </div>

                </div>
                <div class="form-group">

                    <label for="lead_address" class="col-md-12"> 

                        Enter Full Address for Lead Experience

                    </label>

                    <div class="controls">

                       <input type="text" name="lead_address" class="form-control"

                   value=""/>

                    </div>

                </div>
                <div class="btn-group to_whom" data-toggle="buttons">
                    <label for="first_loc_id" class="col-md-12"> 
                        For Whom Filter
                    </label>
                    <div class="col-md-12">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="all" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  For All 
                    </div>    
                    <div class="col-md-12"> 
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="men" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Men     
                    </div>
                    <div class="col-md-12">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="women" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Women   
                    </div> 
                    <div class="col-md-12">  
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="children" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Children    
                    </div>
                    <div class="col-md-12">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="couples" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Couples   
                    </div> 
                    <div class="col-md-12">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="to_whom[]" value="groups" autocomplete="off">
                        <span class="glyphicon glyphicon-ok"></span>
                    </label>  Groups    
                    </div> 
            
                </div>

            </div>

            </fieldset>

            <div class="container">

            <div class="row">

            <!-- Image Section -->

             <div class="product-images form-group col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 cat-image">  

                {{-- <a class="btn btn-primary add-image" href="javascript:void(0);" title="Add New Image"><span class="glyphicon glyphicon-plus"></span> Add Image</a> --}}

               <h6> Upload Images</h6>

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

                            <input type="file" accept="image/png, image/jpeg, image/gif" name="pimages[]" multiple/> <!-- rename it -->

                        </div>

                    </span>

                </div><!-- /input-group image-preview [TO HERE]--> 

            </div>

            </div>

            </div>

            <div style="clear:both"></div>

            



           

            <!-- End of Image Section -->



            <div class="col-md-2 col-lg-2 col-sm-12">

                {{ Form::submit('Save', $attributes = ['class' => 'btn btn-primary pull-left']) }}

                    

                </div>



            {{ Form::close() }}

        </div>

    </div>

</div>



@stop