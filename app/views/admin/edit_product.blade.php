@extends('admin.layout')



@section('content')



<div class="row">

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

                    <fieldset>

                        <br><br><br>

                        <div class="col-md-8 col-lg-8 col-sm-12">

                            <div class="tabbable-panel">

                                <div class="tabbable-line">

                                    <ul class="nav nav-tabs ">

                                        @foreach($products as $index => $product)

                                            <li class="@if($index == 0) active @endif">

                                                <a href="#{{ $product->name }}" data-toggle="tab"> {{ $product->name }} </a>

                                            </li>

                                        @endforeach

                                    </ul>

                                    <div class="tab-content">

                                        @foreach($products as $index => $product)

                                            <div class="tab-pane @if($index == 0)active @endif" id="{{ $product->name }}">

                                                <div class="form-group">

                                                    {{ Form::label('title', 'Title', array('class' => 'col-sm-3 control-label')) }}



                                                    <div class="col-sm-9">

                                                        <input type="text" name="title[{{ $product->id }}]" placeholder="Title" class="form-control" value="{{ $product->title }}" required/>

                                                        {{ $errors->first('title['. $product->id .']') }}

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    {{ Form::label('mini_description', 'Mini Description', array('class' => 'col-sm-3 control-label')) }}



                                                    <div class="col-sm-9">

                                                        <textarea name="mini_description[{{ $product->id }}]" class="form-control" placeholder="Mini Description" >{{ $product->mini_description }}</textarea>

                                                        {{ $errors->first('mini_description['. $product->id .']') }}



                                                    </div>

                                                </div>





                                                <div class="form-group">

                                                    {{ Form::label('description', 'Description', array('class' => 'col-sm-3 control-label')) }}



                                                    <div class="col-sm-9">

                                                        <textarea name="description[{{ $product->id }}]" class="editor form-control" placeholder="Description" >{{ $product->description }}</textarea>

                                                        {{ $errors->first('description['. $product->id .']') }}



                                                    </div>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            </div>
                            <div class="btn-group to_whom" data-toggle="buttons">
                                <label for="first_loc_id" class="col-md-12">
                                    Special
                                </label>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getSpecialClass($p->special, 'for_two') }}">
                                        <input type="checkbox" name="special[]" value="for_two" {{ getSpecial($p->special, 'for_two') }}  autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  For Two
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getSpecialClass($p->special, 'best_seller') }}">
                                        <input type="checkbox" name="special[]" value="best_seller" {{ getSpecial($p->special, 'best_seller') }}  autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Best Seller
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getSpecialClass($p->special, 'with_discount') }}">
                                        <input type="checkbox" name="special[]" value="with_discount" {{ getSpecial($p->special, 'with_discount') }}  autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  With Discount
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getSpecialClass($p->special, 'new') }}">
                                        <input type="checkbox" name="special[]" value="new" {{ getSpecial($p->special, 'new') }}  autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  New
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

                                            @if($cat->cat_id == $p->cat_id)

                                                <option value="{{ $cat->cat_id }}" selected="seleted">{{ $cat->title }}</option>

                                            @else

                                                <option value="{{ $cat->cat_id }}">{{ $cat->title }}</option>

                                            @endif

                                        @endforeach



                                    </select>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="state" class="col-md-12">

                                    Status

                                </label>

                                <div class="controls">

                                    <select name="state" id="state" class=" form-control" required>

                                        <option value="1" @if($p->state == '1') selected="selected" @endif>Published</option>
                                        <option value="0" @if($p->state == '0') selected="selected" @endif>Unpublished</option>
                                    </select>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="first_loc_id" class="col-md-12">

                                    Select Location for First Order

                                </label>

                                <div class="controls">

                                    <select name="first_loc_id" id="first_loc_id" class=" form-control">

                                        <option value="">-Select A Location-</option>

                                        @foreach($locations as $index => $loc)

                                            @if($loc->loc_id == $p->first_loc_id)

                                                <option value="{{ $loc->loc_id }}" selected="seleted">{{ $loc->name }}</option>

                                            @else

                                                <option value="{{ $loc->loc_id }}">{{ $loc->name }}</option>

                                            @endif

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

                                           value="{{ $p->tags }}" data-role="tagsinput" />

                                </div>

                            </div>
                            <div class="btn-group to_whom" data-toggle="buttons">

                                <div class="col-md-12">
                                    <label class="btn btn-primary @if( $p->is_lead  == '1') active @endif">
                                        <input type="checkbox" name="is_lead" value="1" @if( $p->is_lead  == '1') checked @endif autocomplete="off">
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

                                           value="{{ $p->lead_email }}"/>

                                </div>

                            </div>
                            <div class="form-group">

                                <label for="lead_name" class="col-md-12">

                                    Enter Name for Lead Experience

                                </label>

                                <div class="controls">

                                    <input type="text" name="lead_name" class="form-control"

                                           value="{{ $p->lead_name }}"/>

                                </div>

                            </div>
                            <div class="form-group">

                                <label for="lead_phone" class="col-md-12">

                                    Enter Phone for Lead Experience

                                </label>

                                <div class="controls">

                                    <input type="text" name="lead_phone" class="form-control"

                                           value="{{ $p->lead_phone }}"/>

                                </div>

                            </div>
                            <div class="form-group">

                                <label for="lead_address" class="col-md-12">

                                    Enter Full Address for Lead Experience

                                </label>

                                <div class="controls">

                                    <input type="text" name="lead_address" class="form-control"

                                           value="{{ $p->lead_address }}"/>

                                </div>

                            </div>
                            <div class="btn-group to_whom" data-toggle="buttons">
                                <label for="first_loc_id" class="col-md-12">
                                    For Whom Filter
                                </label>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'all') }}">
                                        <input type="checkbox" name="to_whom[]" value="all" {{ getToWhom($p->to_whom, 'all') }}  autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  For All
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'men') }}">
                                        <input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'men') }} value="men" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Men
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'women') }}">
                                        <input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'women') }} value="women" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Women
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'children') }}">
                                        <input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'children') }} value="children" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Children
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'couples') }}">
                                        <input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'couples') }} value="couples" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Couples
                                </div>
                                <div class="col-md-12">
                                    <label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'groups') }}">
                                        <input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'groups') }} value="groups" autocomplete="off">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </label>  Groups
                                </div>

                            </div>



                            <div class="form-group">

                                <a class="btn btn-primary" href="{{ route('list_locations', array($p->id)); }}" title="Manage Locations">Manage Experience's Locations</a>

                            </div>

                            <div class="form-group">

                                <a class="btn btn-primary" href="{{ route('list_efaqs', array($p->id)); }}" title="Manage Locations">FAQ's</a>

                            </div>





                        </div>

                    </fieldset>

                    <div class="container">

                        <div class="row">

                            <!-- Image Section -->

                            <div class="product-images form-group col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 cat-image">

                                {{-- <a class="btn btn-primary add-image" href="javascript:void(0);" title="Add New Image"><span class="glyphicon glyphicon-plus"></span> Add Image</a> --}}

                                <h6> Experience Images</h6>

                                <div class="exp-images">

                                    <div class='list-group gallery'>
                                        <?php
                                        //echo "<pre>";print_r($product_images);die;
                                        ?>

                                        @foreach($product_images as $product_image)



                                            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>

                                                <a class="thumbnail fancybox" rel="ligthbox" href="{{  asset('uploads/products/'.$product_image->image) }}">

                                                    <img class="img-responsive" alt="" src="{{  asset('uploads/products/thumbs/thumb_'.$product_image->image) }}" />



                                                </a>
                                                <a href="{{ route('delete_image', array($product_image->id)); }}" title="Delete">Delete</a>

                                            </div> <!-- col-6 / end -->

                                        @endforeach

                                    </div>

                                </div>

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
    </div>

</div>



@stop