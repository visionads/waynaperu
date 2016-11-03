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
                                                    {{ Form::label('title', trans('product.title'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input type="text" name="title[{{ $product->content_id }}]" placeholder="{{ trans('product.title') }}" class="form-control" value="{{ $product->title }}" required/>
                                                        {{ $errors->first('title['. $product->content_id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('mini_description', trans('product.mini_description'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="mini_description[{{ $product->content_id }}]" class="form-control" placeholder="{{ trans('product.mini_description') }}" >{{ $product->mini_description }}</textarea>
                                                        {{ $errors->first('mini_description['. $product->content_id .']') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('description', trans('product.description'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="description[{{ $product->content_id }}]" id="" class="editor form-control summernote" placeholder="{{ trans('product.description') }}" >{{ $product->description }}</textarea>
                                                        {{ $errors->first('description['. $product->content_id .']') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('includes', trans('product.includes'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->includes }}" name="includes[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.includes') }}" >
                                                        {{ $errors->first('includes['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('schedule_short', trans('product.schedule_short'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->schedule_short }}" name="schedule_short[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.schedule_short') }}" >
                                                        {{ $errors->first('schedule_short['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('duration', trans('product.duration'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->duration }}" name="duration[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.duration') }}" >
                                                        {{ $errors->first('duration['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('required', trans('product.required'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="required[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.required') }}" >{{ $product->required }}</textarea>
                                                        {{ $errors->first('required['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('terms_of_reservation', trans('product.terms_of_reservation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="terms_of_reservation[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.terms_of_reservation') }}" >{{ $product->terms_of_reservation }}</textarea>
                                                        {{ $errors->first('terms_of_reservation['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('terms_of_cancellation', trans('product.terms_of_cancellation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="terms_of_cancellation[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.terms_of_cancellation') }}" >{{ $product->terms_of_cancellation }}</textarea>
                                                        {{ $errors->first('terms_of_cancellation['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('restriction', trans('product.restriction'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="restriction[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.restriction') }}" >{{ $product->restriction }}</textarea>
                                                        {{ $errors->first('restriction['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('recommendation', trans('product.recommendation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="recommendation[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.recommendation') }}" >{{ $product->recommendation }}</textarea>
                                                        {{ $errors->first('recommendation['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('not_include', trans('product.not_include'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="not_include[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.not_include') }}" >{{ $product->not_include }}</textarea>
                                                        {{ $errors->first('not_include['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('other_information', trans('product.other_information'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="other_information[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.other_information') }}" >{{ $product->other_information }}</textarea>
                                                        {{ $errors->first('other_information['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('validity', trans('product.validity'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->validity }}" name="validity[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.validity') }}" >
                                                        {{ $errors->first('validity['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('itinerary', trans('product.itinerary'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->itinerary }}" name="itinerary[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.itinerary') }}" >
                                                        {{ $errors->first('itinerary['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('department', trans('product.department'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->department }}" name="department[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.department') }}" >
                                                        {{ $errors->first('department['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('city', trans('product.city'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->city }}" name="city[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.city') }}" >
                                                        {{ $errors->first('city['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('street', trans('product.street'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ isset($product->street)?$product->street:null }}" name="street[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.street') }}" >
                                                        {{ $errors->first('street['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('district', trans('product.district'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->district }}" name="district[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.district') }}" >
                                                        {{ $errors->first('district['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('price_with_tax', trans('product.price_with_tax'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->price_with_tax }}" name="price_with_tax[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.price_with_tax') }}" >
                                                        {{ $errors->first('price_with_tax['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('commission_previous', trans('product.commission_previous'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->commission_previous }}" name="commission_previous[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.commission_previous') }}" >
                                                        {{ $errors->first('commission_previous['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('final_commission_of_25', trans('product.final_commission_of_25'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->final_commission_of_25 }}" name="final_commission_of_25[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.final_commission_of_25') }}" >
                                                        {{ $errors->first('final_commission_of_25['. $product->id .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('provider_price', trans('product.provider_price'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input value="{{ $product->provider_price }}" name="provider_price[{{ $product->id }}]" class="editor form-control" placeholder="{{ trans('product.provider_price') }}" >
                                                        {{ $errors->first('provider_price['. $product->id .']') }}
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
                                <label for="provider" class="col-md-12">
                                    {{ trans('product.provider_name') }}
                                </label>
                                <div class="controls">
                                    <select name="user_id" id="provider" class=" form-control" required>
                                        <option value="">-Select A Provider-</option>
                                        @foreach($providers as $index => $provider)
                                            <option @if($p->user_id==$provider->id) selected @endif value="{{ $provider->id }}">{{ $provider->first_name.' '.$provider->last_name.' ('.$provider->email.')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p style="padding: 10px; background: #efefef;">
                                    @if(count($user_provider)>0)
                                        Provider ID : {{isset($user_provider->id)?$user_provider->id:null}}
                                        <br>
                                        Provider Name : {{isset($user_provider->first_name)?$user_provider->first_name:null}} {{isset($user_provider->last_name)?$user_provider->last_name:'N/A'}}
                                        <br>
                                        Provider Email : {{isset($user_provider->email)?$user_provider->email:'N/A'}}
                                        <br>
                                        Provider Phone : {{isset($user_provider->phone)?$user_provider->phone:'N/A'}}
                                        <br>
                                        District : {{isset($user_provider->district)?$user_provider->district:'N/A'}}
                                        <br>
                                        City : {{isset($user_provider->city)?$user_provider->city:'N/A'}}
                                        <br>
                                        In-charge : {{isset($user_provider->incharge)?$user_provider->incharge:'N/A'}}
                                        <br>
                                        <u>Phone Numbers</u>
                                        <br>
                                        @if(isset($provider_phones) && count($provider_phones)>0)
                                            @foreach($provider_phones as $provider_phone)
                                                <b>
                                                    @if($provider_phone->type==1)
                                                        Telephone
                                                    @elseif($provider_phone->type==2)
                                                        RPC
                                                    @elseif($provider_phone->type==3)
                                                        RPM
                                                    @endif
                                                    : </b>
                                                {{ $provider_phone->number }}
                                            @endforeach
                                        @endif

                                    @endif
                                </p>
                            </div>
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
                                    <input type="text" name="tags" class="form-control" value="{{ $p->tags }}" data-role="tagsinput" />
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="category" class="col-md-12">
                                    {{ trans('product.payment_type') }}
                                </label>
                                <div class="controls">
                                    <select name="type_of_payment" id="type_of_payment" class=" form-control" required>
                                        <option value="">-Select type of payment-</option>
                                        <option @if($p->type_of_payment == '1') selected="selected" @endif value="1">100% before</option>
                                        <option @if($p->type_of_payment == '2') selected="selected" @endif value="2">50-50%</option>
                                        <option @if($p->type_of_payment == '3') selected="selected" @endif value="3">100% afterwards</option>
                                    </select>
                                </div>
                            </div>
                            {{--<div class="btn-group to_whom" data-toggle="buttons">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary @if( $p->is_lead  == '1') active @endif">--}}
                                        {{--<input type="checkbox" name="is_lead" value="1" @if( $p->is_lead  == '1') checked @endif autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Check If Product is a Lead.--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_email" class="col-md-12">--}}
                                    {{--Enter Email for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_email" class="form-control" value="{{ $p->lead_email }}"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_name" class="col-md-12">--}}
                                    {{--Enter Name for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_name" class="form-control" value="{{ $p->lead_name }}"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_phone" class="col-md-12">--}}
                                    {{--Enter Phone for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_phone" class="form-control" value="{{ $p->lead_phone }}"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_address" class="col-md-12">--}}
                                    {{--Enter Full Address for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_address" class="form-control" value="{{ $p->lead_address }}"/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group to_whom" data-toggle="buttons">--}}
                                {{--<label for="first_loc_id" class="col-md-12">--}}
                                    {{--For Whom Filter--}}
                                {{--</label>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'all') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="all" {{ getToWhom($p->to_whom, 'all') }}  autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  For All--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'men') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'men') }} value="men" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Men--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'women') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'women') }} value="women" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Women--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'children') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'children') }} value="children" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Children--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'couples') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'couples') }} value="couples" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Couples--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary {{ getToWhomClass($p->to_whom, 'groups') }}">--}}
                                        {{--<input type="checkbox" name="to_whom[]" {{ getToWhom($p->to_whom, 'groups') }} value="groups" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Groups--}}
                                {{--</div>--}}

                            {{--</div>--}}
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{ route('list_locations', array($p->id)); }}" title="Manage Locations">Manage Experience's Locations</a>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{ route('list_efaqs', array($p->id)); }}" title="Manage Locations">FAQ's</a>
                            </div>
                        </div>

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

@stop