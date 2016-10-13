@extends('admin.layout')

@section('content')

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    {{--<div class="panel-body">
        <div class=""><button data-toggle="modal" data-target="#addLocationModal" class="btn btn-primary center-block">Add New Location</button></div>
        @if(count($locations) > 0)
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover" id="sample-table-2">
                        <thead>
                        <tr>
                            <th class="center">
                                <div class="checkbox-table">
                                    <label>
                                        Location ID
                                    </label>
                                </div>
                            </th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td class="center">
                                    <div class="checkbox-table">
                                        <label>
                                            {{ $location->loc_id }}
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $location->name }}</td>
                                <td class="center">
                                    <div class="visible-md visible-lg hidden-sm hidden-xs">
                                        <a data-locid ="{{ $location->loc_id }}" class="editloc btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$location->loc_id}},'locations/delete')"><i class="fa fa-times fa fa-white"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p> No Location Found. </p>
        @endif
    </div>--}}







    {{-- Add Location --}}

            <!-- line modal -->

    <div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Add Location</h3>
                </div>

                <div class="modal-body">
                    <form id="add_location">
                        <input type="hidden" name="product_id" value="{{ $product_id }}">
                        <fieldset>
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
                                                        {{ Form::label('name', 'Name', array('class' => 'col-sm-3 control-label')) }}
                                                        <div class="col-sm-9">
                                                            <input type="text" name="name[{{ $language->code }}]" placeholder="Name" class="form-control">
                                                            {{ $errors->first('name['. $language->code .']') }}
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="details_{{ $language->code }}">
                                                            <input type="hidden" name="count" id="count" value="1" />
                                                            <div class="control-group" id="fields">
                                                                <label class="control-label" for="details_cat1">Details</label>

                                                                {{--==*****==--}}
                                                                <div class="form-group">
                                                                    <input type="text" value="@if($language->code=='en') Include @elseif($language->code=='es') Incluido @endif" name="include[{{ $language->code }}]" placeholder="{{ trans('text.include') }}" class="form-control">
                                                                    <input type="text" name="include_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Schedule @elseif($language->code=='es') Horario @endif" name="schedule[{{ $language->code }}]" placeholder="{{ trans('text.schedule') }}" class="form-control">
                                                                    <input type="text" name="schedule_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Duration @elseif($language->code=='es') Duración @endif" name="duration[{{ $language->code }}]" placeholder="{{ trans('text.duration') }}" class="form-control">
                                                                    <input type="text" name="duration_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Requisites @elseif($language->code=='es') Requisitos @endif" name="requisites[{{ $language->code }}]" placeholder="{{ trans('text.requisites') }}" class="form-control">
                                                                    <input type="text" name="requisites_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Restrictions @elseif($language->code=='es') Restricciones @endif" name="restrictions[{{ $language->code }}]" placeholder="{{ trans('text.restrictions') }}" class="form-control">
                                                                    <input type="text" name="restrictions_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Recommendations @elseif($language->code=='es') Recomendaciones @endif" name="recommendations[{{ $language->code }}]" placeholder="{{ trans('text.recommendations') }}" class="form-control">
                                                                    <input type="text" name="recommendations_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Terms of Reservation @elseif($language->code=='es') Terminos de Reservacion @endif" name="terms_of_reservation[{{ $language->code }}]" placeholder="{{ trans('text.terms_of_reservation') }}" class="form-control">
                                                                    <input type="text" name="terms_of_reservation_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Terms of Cancelation @elseif($language->code=='es') Terminos de Cancelacion @endif" name="terms_of_cancelation[{{ $language->code }}]" placeholder="{{ trans('text.terms_of_cancelation') }}" class="form-control">
                                                                    <input type="text" name="terms_of_cancelation_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Not Include @elseif($language->code=='es') No incluido @endif" name="not_include[{{ $language->code }}]" placeholder="{{ trans('text.not_include') }}" class="form-control">
                                                                    <input type="text" name="not_include_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="@if($language->code=='en') Info @elseif($language->code=='es') Info @endif" name="info[{{ $language->code }}]" placeholder="{{ trans('text.info') }}" class="form-control">
                                                                    <input type="text" name="info_value[{{ $language->code }}]" placeholder="value" class="form-control">
                                                                </div>
                                                                {{--<div class="form-group">
                                                                    <input type="text" value="{{ trans('text.include') }}" name="include[{{ $language->code }}]" placeholder="{{ trans('text.include') }}" class="form-control">
                                                                    <input type="text" name="include_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.schedule') }}" name="schedule[{{ $language->code }}]" placeholder="{{ trans('text.schedule') }}" class="form-control">
                                                                    <input type="text" name="schedule_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.duration') }}" name="duration[{{ $language->code }}]" placeholder="{{ trans('text.duration') }}" class="form-control">
                                                                    <input type="text" name="duration_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.requisites') }}" name="requisites[{{ $language->code }}]" placeholder="{{ trans('text.requisites') }}" class="form-control">
                                                                    <input type="text" name="requisites_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.restrictions') }}" name="restrictions[{{ $language->code }}]" placeholder="{{ trans('text.restrictions') }}" class="form-control">
                                                                    <input type="text" name="restrictions_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.recommendations') }}" name="recommendations[{{ $language->code }}]" placeholder="{{ trans('text.recommendations') }}" class="form-control">
                                                                    <input type="text" name="recommendations_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.terms_of_reservation') }}" name="terms_of_reservation[{{ $language->code }}]" placeholder="{{ trans('text.terms_of_reservation') }}" class="form-control">
                                                                    <input type="text" name="terms_of_reservation_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.terms_of_cancelation') }}" name="terms_of_cancelation[{{ $language->code }}]" placeholder="{{ trans('text.terms_of_cancelation') }}" class="form-control">
                                                                    <input type="text" name="terms_of_cancelation_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.not_include') }}" name="not_include[{{ $language->code }}]" placeholder="{{ trans('text.not_include') }}" class="form-control">
                                                                    <input type="text" name="not_include_value[{{ $language->code }}]" placeholder="value" class="form-control">

                                                                    <input type="text" value="{{ trans('text.info') }}" name="info[{{ $language->code }}]" placeholder="{{ trans('text.info') }}" class="form-control">
                                                                    <input type="text" name="info_value[{{ $language->code }}]" placeholder="value" class="form-control">
                                                                </div>--}}

                                                                {{--==*****==--}}


                                                                <div class="controls" id="profs">
                                                                    <div class="input-append">
                                                                        <input autocomplete="off" class="form-control  col-md-3" id="details_cat1" name="details_cat[{{ $language->code }}][]" type="text" placeholder="Detail's Category"/>
                                                                        <input autocomplete="off" class="form-control  col-md-3" id="details_val1" name="details_val[{{ $language->code }}][]" type="text" placeholder="Detail's Value"/><button id="b1" class="btn btn-info add-more" type="button" data-code="{{ $language->code }}">+</button>
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
                                    <label for="pdf">{{ trans('text.price_adult') }}</label>
                                    <input type="text" class="form-control" id="pdf" name="pdf" placeholder="Value">
                                </div>
                                <div class="form-group">
                                    <label for="mail">{{ trans('text.price_kid') }}</label>
                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Value">
                                </div>
                                <div class="form-group">
                                    <label for="gift">{{ trans('text.price_discount') }}</label>
                                    <input type="text" class="form-control" id="gift" name="gift" placeholder="Value">
                                </div>
                                <div class="form-group">
                                    <label for="district_id" class="col-md-12">District</label>
                                    <div class="controls">
                                        <select name="district_id" id="district_id" class=" form-control" required>
                                            <option value="">-Select A District-</option>
                                            @foreach($districts as $index => $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>

                                <h6>Assign Experience Image</h6>

                                <div class="row">
                                    @foreach($product_images as $product_image)
                                        <div class="col-xs-4">
                                            {{-- <a class="thumbnail fancybox" rel="ligthbox" href="{{  asset('uploads/products/'.$product_image->image) }}"> --}}

                                            {{--  </a> --}}

                                            {{-- <button type="button" class="btn btn-primary btn-radio">Select Image</button> --}}

                                            <img src="{{  asset('uploads/products/thumbs/thumb_'.$product_image->image) }}" class="img-responsive img-radio">
                                            <input type="radio" name="product_image_id" value="{{ $product_image->id }}"  class="hidden">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>

                        {{-- <div class="btn-group btn-delete hidden" role="group">

                            <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>

                        </div> --}}

                        <div class="btn-group" role="group">
                            <button type="button" data-dismiss="modal" id="saveLocation" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Edit Location --}}

            <!-- line modal -->

    <div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Edit Location</h3>
                </div>
                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" data-dismiss="modal" id="updateLocation" class="btn btn-default btn-hover-green" data-action="save" role="button">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function(){

            var next = 1;

            $(".add-more").on("click", function(e){

                e.preventDefault();

                var code = $(this).data('code');

                next = parseInt($(".details_"+code+" #count").val(), 10);

                console.log(code);

                var addto = ".details_"+code+" #details_val" + next;

                next = next + 1;

                var newIn = '<br /><br /><input autocomplete="off" class="form-control col-md-3" id="details_cat'+next+'" name="details_cat['+code+'][]" type="text" placeholder="Details Category"> <input autocomplete="off" class="form-control  col-md-3" id="details_val'+next+'" name="details_val['+code+'][]" type="text" placeholder="Details Value">';

                var newInput = $(newIn);

                $(addto).after(newInput);

                // $("#details_val" + next).attr('data-source',$(addto).attr('data-source'));

                $(".details_"+code+" #count").val(next);

            });

            $(document).on("click", ".add-moree", function(e){

                e.preventDefault();

                var code = $(this).data('codee');

                next = parseInt($(".details_"+code+" #countt").val(), 10);

                console.log(next);

                var addto = ".details_"+code+" #details_val" + next;

                next = next + 1;

                var newIn = '<br /><br /><input autocomplete="off" class="form-control col-md-3" id="details_cat'+next+'" name="details_cat['+code+'][]" type="text" placeholder="Details Category"> <input autocomplete="off" class="form-control  col-md-3" id="details_val'+next+'" name="details_val['+code+'][]" type="text" placeholder="Details Value">';

                var newInput = $(newIn);

                $(addto).after(newInput);

                // $("#details_val" + next).attr('data-source',$(addto).attr('data-source'));

                $(".details_"+code+" #countt").val(next);

            });

            $("#saveLocation").on("click",function(){



                var data = $('form#add_location').serialize();

                var URL = '{{ route("save_location") }}';

                $.post(URL,data,function(response){

                    // console.log(response)

                },"json")

            });

            $("#updateLocation").on("click",function(){



                var data = $('form#edit_location').serialize();

                var URL = '{{ route("update_location") }}';

                $.post(URL,data,function(response){

                    //console.log(response)

                },"json")

            });

            $('#addLocationModal, #editLocationModal').on('hidden.bs.modal', function () {

                setTimeout(function(){ location.reload(); }, 2000);

            })


            $('a.editloc').on('click', function() {

                $('#editLocationModal').modal('show');

                var location_id = $(this).data('locid');

                var product_id  = {{ $product_id }};

                var URL = '{{ URL::to('/') }}/admin/location/'+product_id+'/edit/'+location_id;



                $.get(URL, function(response){

                    // console.log(response);

                    $('#editLocationModal .modal-body').html(response);

                });
            })
        });

    </script>

@stop

