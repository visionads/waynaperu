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
                                        @foreach($languages as $index => $language)
                                            <li class="@if($index == 0) active @endif">
                                                <a href="#{{ $language->name }}" data-toggle="tab"> {{ trans($language->name) }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($languages as $index => $language)
                                            <div class="tab-pane @if($index == 0)active @endif" id="{{ $language->name }}">
                                                <div class="form-group">
                                                    {{ Form::label('title', trans('product.title'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input type="text" name="title[{{ $language->code }}]" placeholder="{{ trans('product.title') }}" class="form-control" required/>
                                                        {{ $errors->first('title['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('mini_description', trans('product.mini_description'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="mini_description[{{ $language->code }}]" class="form-control" placeholder="{{ trans('product.mini_description') }}" ></textarea>
                                                        {{ $errors->first('mini_description['. $language->code .']') }}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    {{ Form::label('description', trans('product.description'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="description[{{ $language->code }}]" class="editor form-control summernote" placeholder="{{ trans('product.description') }}" ></textarea>
                                                        {{ $errors->first('description['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('includes', trans('product.includes'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="includes[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.includes') }}" >
                                                        {{ $errors->first('includes['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('schedule_short', trans('product.schedule_short'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="schedule_short[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.schedule_short') }}" >
                                                        {{ $errors->first('schedule_short['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('duration', trans('product.duration'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="duration[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.duration') }}" >
                                                        {{ $errors->first('duration['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('required', trans('product.required'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="required[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.required') }}" ></textarea>
                                                        {{ $errors->first('required['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('terms_of_reservation', trans('product.terms_of_reservation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="terms_of_reservation[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.terms_of_reservation') }}" ></textarea>
                                                        {{ $errors->first('terms_of_reservation['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('terms_of_cancellation', trans('product.terms_of_cancellation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="terms_of_cancellation[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.terms_of_cancellation') }}" ></textarea>
                                                        {{ $errors->first('terms_of_cancellation['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('restriction', trans('product.restriction'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="restriction[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.restriction') }}" ></textarea>
                                                        {{ $errors->first('restriction['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('recommendation', trans('product.recommendation'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="recommendation[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.recommendation') }}" ></textarea>
                                                        {{ $errors->first('recommendation['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('not_include', trans('product.not_include'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="not_include[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.not_include') }}" ></textarea>
                                                        {{ $errors->first('not_include['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('other_information', trans('product.other_information'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <textarea name="other_information[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.other_information') }}" ></textarea>
                                                        {{ $errors->first('other_information['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('validity', trans('product.validity'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="validity[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.validity') }}" >
                                                        {{ $errors->first('validity['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('itinerary', trans('product.itinerary'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="itinerary[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.itinerary') }}" >
                                                        {{ $errors->first('itinerary['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('department', trans('product.department'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="department[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.department') }}" >
                                                        {{ $errors->first('department['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('city', trans('product.city'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="city[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.city') }}" >
                                                        {{ $errors->first('city['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('street', trans('product.street'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="street[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.street') }}" >
                                                        {{ $errors->first('street['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('district', trans('product.district'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="district[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.district') }}" >
                                                        {{ $errors->first('district['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('price_with_tax', trans('product.price_with_tax'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="price_with_tax[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.price_with_tax') }}" >
                                                        {{ $errors->first('price_with_tax['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('commission_previous', trans('product.commission_previous'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="commission_previous[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.commission_previous') }}" >
                                                        {{ $errors->first('commission_previous['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('final_commission_of_25', trans('product.final_commission_of_25'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="final_commission_of_25[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.final_commission_of_25') }}" >
                                                        {{ $errors->first('final_commission_of_25['. $language->code .']') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{ Form::label('provider_price', trans('product.provider_price'), array('class' => 'col-sm-3 control-label')) }}
                                                    <div class="col-sm-9">
                                                        <input name="provider_price[{{ $language->code }}]" class="editor form-control" placeholder="{{ trans('product.provider_price') }}" >
                                                        {{ $errors->first('provider_price['. $language->code .']') }}
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
                                    {{ trans('product.provider_name') }}
                                </label>
                                <div class="controls">
                                    <select name="user_id" id="provider" class=" form-control" required>
                                        <option value="">-Select A Provider-</option>
                                        @foreach($providers as $index => $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->username.' ('.$provider->first_name.' '.$provider->last_name.')' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-md-12">
                                    {{ trans('product.category') }}
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
                                    {{ trans('product.enter_tags_for_experience') }}
                                </label>
                                <div class="controls">
                                    <input type="text" name="tags" class="form-control" value="" data-role="tagsinput" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category" class="col-md-12">
                                    {{ trans('product.payment_type') }}
                                </label>
                                <div class="controls">
                                    <select name="type_of_payment" id="type_of_payment" class=" form-control" required>
                                        <option value="">-Select type of payment-</option>
                                        <option value="1">100% before</option>
                                        <option value="2">50-50%</option>
                                        <option value="3">100% afterwards</option>
                                    </select>
                                </div>
                            </div>
                            {{--<div class="btn-group to_whom" data-toggle="buttons">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="is_lead" value="1" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Check If Product is a Lead.--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_email" class="col-md-12">--}}
                                    {{--Enter Email for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_email" class="form-control" value=""/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_name" class="col-md-12">--}}
                                    {{--Enter Name for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_name" class="form-control" value=""/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_phone" class="col-md-12">--}}
                                    {{--Enter Phone for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_phone" class="form-control" value=""/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lead_address" class="col-md-12">--}}
                                    {{--Enter Full Address for Lead Experience--}}
                                {{--</label>--}}
                                {{--<div class="controls">--}}
                                    {{--<input type="text" name="lead_address" class="form-control" value=""/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group to_whom" data-toggle="buttons">--}}
                                {{--<label for="first_loc_id" class="col-md-12">--}}
                                    {{--For Whom Filter--}}
                                {{--</label>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="all" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  For All--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="men" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Men--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="women" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Women--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="children" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Children--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="couples" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Couples--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label class="btn btn-primary">--}}
                                        {{--<input type="checkbox" name="to_whom[]" value="groups" autocomplete="off">--}}
                                        {{--<span class="glyphicon glyphicon-ok"></span>--}}
                                    {{--</label>  Groups--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

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
    </div>

@stop