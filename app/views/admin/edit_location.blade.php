<div class="card">
    <div class="card-body">
        <form id="edit_location">

            <input type="hidden" name="product_id" value="{{ $loc->product_id }}">

            <input type="hidden" name="location_id" value="{{ $loc->id }}">

            <fieldset>

                <div class="col-md-8 col-lg-8 col-sm-12">

                    <div class="tabbable-panel">

                        <div class="tabbable-line">

                            <ul class="nav nav-tabs ">

                                @foreach($locations as $index => $location)

                                    <li class="@if($index == 0) active @endif">

                                        <a href="#edit_{{ $location->lang_name }}" data-toggle="tab"> {{ $location->lang_name }} </a>

                                    </li>

                                @endforeach

                            </ul>

                            <div class="tab-content">

                                @foreach($locations as $index => $location)

                                    <div class="tab-pane @if($index == 0)active @endif" id="edit_{{ $location->lang_name }}">

                                        <div class="form-group">

                                            {{ Form::label('name', 'Name', array('class' => 'col-sm-3 control-label')) }}



                                            <div class="col-sm-9">

                                                <input value="{{ $location->name }}" type="text" name="name[{{ $location->id }}]" placeholder="Name" class="form-control"/>

                                                {{ $errors->first('name['. $location->id .']') }}

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <div class="details_{{ $location->id }}">

                                                <?php

                                                $details = json_decode($location->details);

                                                //echo "<pre>";print_r($details);die;

                                                ?>

                                                <?php $count = 0 ?>

                                                @foreach($details as $val)

                                                    <?php $count++ ?>

                                                @endforeach

                                                <input type="hidden" name="count" id="countt" value="{{ $count }}" />

                                                <div class="control-group" id="fields">

                                                    <label class="control-label" for="details_cat1">Details</label>

                                                    <div class="controls" id="profs">

                                                        <div class="input-append">

                                                            <?php $i = 1; ?>

                                                            @foreach($details as $key => $val)

                                                                <input autocomplete="off" class="form-control  col-md-3" id="details_cat{{ $i }}" name="details_cat[{{ $location->id }}][]" type="text" placeholder="Detail's Category" value="{{ $key }}"/>

                                                                <input autocomplete="off" class="form-control  col-md-3" id="details_val{{ $i }}" name="details_val[{{ $location->id }}][]" type="text" placeholder="Detail's Value" value="{{ $val }}"/>

                                                                @if($i < $count)

                                                                    <br /><br />

                                                                @endif

                                                                <?php $i++; ?>

                                                            @endforeach

                                                            <button id="b1" class="btn btn-info add-moree" type="button" data-codee="{{ $location->id }}">+</button>

                                                        </div>



                                                    </div>

                                                </div>



                                            </div>

                                        </div>



                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-lg-4 col-sm-12">

                    <h6>Price</h6>



                    <div class="form-group">

                        <label for="pdf">PDF</label>

                        <input value="{{ $loc->price1 }}" type="text" class="form-control" id="pdf" name="pdf" placeholder="Price">

                    </div>

                    <div class="form-group">

                        <label for="mail">Mail</label>

                        <input value="{{ $loc->price2 }}" type="text" class="form-control" id="mail" name="mail" placeholder="Price">

                    </div>

                    <div class="form-group">

                        <label for="gift">Gift</label>

                        <input value="{{ $loc->price3 }}" type="text" class="form-control" id="gift" name="gift" placeholder="Price">

                    </div>

                    <div class="form-group">

                        <label for="district_id" class="col-md-12">

                            District

                        </label>

                        <div class="controls">

                            <select name="district_id" id="district_id" class=" form-control" required>

                                <option value="">-Select A District-</option>

                                @foreach($districts as $index => $district)



                                    @if($district->id == $loc->district_id)

                                        <option value="{{ $district->id }}" selected="seleted">{{ $district->name }}</option>

                                    @else

                                        <option value="{{ $district->id }}">{{ $district->name }}</option>

                                    @endif

                                @endforeach



                            </select>

                        </div>

                    </div>

                    <div style="clear:both;"></div>

                    <h6>Assign Experience Image</h6>

                    <div class="row">

                        @foreach($product_images as $product_image)

                            <div class="col-xs-4">





                                @if($product_image->id == $loc->product_image_id)

                                    <img src="{{  asset('uploads/products/thumbs/thumb_'.$product_image->image) }}" class="img-responsive img-radio" style="opacity:1;">

                                    <input type="radio" name="product_image_id" value="{{ $product_image->id }}"  class="hidden" checked>

                                @else

                                    <img src="{{  asset('uploads/products/thumbs/thumb_'.$product_image->image) }}" class="img-responsive img-radio">

                                    <input type="radio" name="product_image_id" value="{{ $product_image->id }}"  class="hidden" >

                                @endif

                            </div>

                        @endforeach

                    </div>



                </div>





            </fieldset>





        </form>
    </div>
</div>

      