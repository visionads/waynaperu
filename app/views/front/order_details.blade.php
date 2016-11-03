@extends('front.layout')
@extends('front.header')
@extends('front.sidebar')
@extends('front.footer')
@section('content')

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="tab_wrapper">
                <div class="page_paggination">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('home') }}" title="Home">{{trans('text.home')}}</a></li>
                                <li class="active">{{trans('text.profile')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>


                <h4 class="title2">{{ trans('text.order_details') }}</h4>

                <div class="tabs_inner_wrapper">

                    <div class="tab_content_main">
                        <div class="row custom_bg">
                            <div class="col-md-12">

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">

                                        <!-- tab content -->
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">{{ trans('provider.order') }}</legend>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_number') }}:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->order_number) ? $order->order_number : null }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status" class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_status') }}:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->status) ? $order->status : null }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.total_qty') }}:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->qty) ? $order->qty : '0' }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.total_price') }}:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            @if(isset($order->price))
                                                                <strong style="line-height:42px;">s./ <?php echo sprintf('%.2f', $order->price); ?></strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">{{ trans('provider.my_information') }}</legend>
                                                    @if($order->user_id == NULL)
                                                        <p>This Order is by guest user and You can get his details on "Order Items" section.</p>
                                                    @else
                                                        <?php $user = getUserInfo($order->user_id);?>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.name') }}:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                @if($user->first_name != '' || $user->last_name != '' )
                                                                    <strong style="line-height:42px;">{{ $user->first_name }} {{ $user->last_name }}</strong>
                                                                @else
                                                                    <strong style="line-height:42px;">User didn't add his Name</strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.email') }}:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <strong style="line-height:42px;">{{ isset($user->email) ? $user->email : null }} </strong>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.address') }}:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                @if($user->direction != '')
                                                                    <strong >
                                                                        #{{ isset($user->flat) ? $user->flat : null }},
                                                                        {{ isset($user->direction) ? $user->direction : null }}
                                                                        <br/>
                                                                        {{ isset($user->city) ? $user->city : null }},
                                                                        {{ isset($user->district) ? $user->district : null }}
                                                                        <br/>
                                                                        {{ isset($user->province) ? $user->province : null }}
                                                                    </strong>
                                                                @else
                                                                    <strong style="line-height:42px;">User Didn't add his address. </strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </fieldset>
                                            </div>









                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">{{ trans('provider.order_items') }}</legend>

                                                    <table  class="table table-striped table-hover" id="sample-table-2">
                                                        <thead>
                                                            <tr>
                                                                <th> {{ trans('provider.product_name') }} </th>
                                                                <th> {{ trans('provider.adult_qty') }} </th>
                                                                <th> {{ trans('provider.adult_price') }} </th>
                                                                <th> {{ trans('provider.child_qty') }} </th>
                                                                <th> {{ trans('provider.child_price') }} </th>
                                                                <th> {{ trans('provider.gift_qty') }} </th>
                                                                <th> {{ trans('provider.gift_price') }} </th>
                                                                <th> {{ trans('provider.date_of_purchase') }} </th>
                                                                <th> {{ trans('provider.provider_info') }} </th>
                                                                <th> {{ trans('provider.ticket_status') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(isset($order_items))
                                                            @foreach($order_items as $item_id=>$item)
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                        $product_content = getProductContentPerProductId($item->product_id);
                                                                        ?>
                                                                        {{ isset($product_content->title)?$product_content->title: null }}
                                                                        <br>
                                                                        Location -

                                                                        <?php $loc_name = getLocName($item->loc_id); ?>
                                                                        {{ isset($loc_name)?$loc_name: null }}
                                                                    </td>
                                                                    <td> {{ isset($item->pdf_qty)?$item->pdf_qty: null }} </td>
                                                                    <td>  s./ {{ isset($item->pdf_price)?$item->pdf_price: null }} </td>
                                                                    <td> {{ isset($item->mail_qty)?$item->mail_qty: null }} </td>
                                                                    <td>  s./ {{ isset($item->mail_price)?$item->mail_price  : null }} </td>
                                                                    <td> {{ isset($item->gift_qty)?$item->gift_qty: null }} </td>
                                                                    <td>  s./ {{ isset($item->gift_price)?$item->gift_price: null }} </td>
                                                                    <td>
                                                                        {{ isset($item->created_at)?date('d M Y'): null }}
                                                                        <br>
                                                                        <b>Valid Until :</b>
                                                                        <?php

                                                                        $product_info= getProductDetailsByProductId($item->product_id);
                                                                        echo date("d M Y",strtotime("+".$product_info->validity." months"))
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        $product = getProductInfoByProductId($item->product_id);
                                                                        if(count($product)>0)
                                                                        {
                                                                            $user_id = $product->user_id;
                                                                            $provider = getUserInfo($user_id);
                                                                            $provider_phones = getUserPhoneNumber($user_id);
                                                                            if(count($provider)>0)
                                                                            {
                                                                                $provider = $provider;
                                                                            }else{
                                                                                $provider = null;
                                                                            }
                                                                        }
                                                                        ?>
                                                                        {{ isset($provider->first_name)? $provider->first_name : null }}
                                                                        {{ isset($provider->last_name)? $provider->last_name : null }}
{{--                                                                        ({{ isset($provider->phone)? $provider->phone : "no phone" }})--}}
                                                                        <br>
                                                                        {{ isset($provider->email)? $provider->email.'<br>' : null }}
                                                                        {{ isset($provider->direction)? $provider->direction.'<br>' : null }}
                                                                        {{ isset($provider->district)? $provider->district.'<br>' : null }}
                                                                        {{ isset($provider->city)? $provider->city.'<br>' : null }}
                                                                        {{ isset($provider->street)? $provider->street.'<br>' : null }}
                                                                        {{ isset($provider->address)? $provider->address : null }}
                                                                            @if(isset($provider_phones) && count($provider_phones)>0)
                                                                                <br>
                                                                                <u>{{ trans('provider.phone_number') }}</u>
                                                                            <br>
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
                                                                    </td>
                                                                    <td>
                                                                        {{ $item->status }}<br>
                                                                        <b>Ticket Number : </b>
                                                                        {{ $item->ticket_number }}<br>
                                                                        <b>Date of Activity : </b>
                                                                        {{ $item->used_at }}
                                                                        {{--@if(isset($item->user_id))
                                                                            @if($item->status=='used')
                                                                                Used
                                                                            @elseif(Auth::user()->type=='admin' || ($item->status=='new' && $item->user_id==Auth::user()->id))
                                                                                {{ Form::open(['route'=>'submit-ticket']) }}
                                                                                <input name="order_item_id" type="hidden" value="{{ $item->id }}" class="form-control" placeholder="Enter Ticket Code">
                                                                                <input name="order_id" type="hidden" value="{{ $order->id }}" class="form-control" placeholder="Enter Ticket Code">
                                                                                <div class="input-group">
                                                                                    <input required name="ticket_number" type="text" class="form-control" placeholder="Enter Ticket Code">
                                                                                    <span class="input-group-btn"><button class="btn btn-default" type="submit">Go!</button></span>
                                                                                </div>
                                                                                {{ Form::close() }}
                                                                            @endif
                                                                        @endif--}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /#page-content-wrapper -->
@stop
