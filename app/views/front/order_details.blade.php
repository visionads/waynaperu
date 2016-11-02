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
                                                    <legend class="scheduler-border">Order</legend>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Order Number:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->order_number) ? $order->order_number : null }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status" class="col-sm-12 col-md-4 control-label">Order Status:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->status) ? $order->status : null }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Total Qty:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ isset($order->qty) ? $order->qty : '0' }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Total Price:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            @if(isset($order->price))
                                                                <strong style="line-height:42px;">s./ <?php echo sprintf('%.2f', $order->price / 100); ?></strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">My Information</legend>
                                                    @if($order->user_id == NULL)
                                                        <p>This Order is by guest user and You can get his details on "Order Items" section.</p>
                                                    @else
                                                        <?php $user = getUserInfo($order->user_id);?>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">Name:</label>
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
                                                            <label  class="col-sm-12 col-md-4 control-label">Email:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <strong style="line-height:42px;">{{ isset($user->email) ? $user->email : null }} </strong>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">Address:</label>
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
                                                    <legend class="scheduler-border">Order Items</legend>

                                                    <table  class="table table-striped table-hover" id="sample-table-2">
                                                        <thead>
                                                            <tr>
                                                                <th> Product Name </th>
                                                                <th> Adult Qty </th>
                                                                <th> Adult Price </th>
                                                                <th> Child Qty </th>
                                                                <th> Child Price </th>
                                                                <th> Gift Qty </th>
                                                                <th> Gift Price </th>
                                                                <th> Date of Purchase </th>
                                                                <th> Provider's INFO </th>
                                                                <th> Ticket Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if(isset($order_items))
                                                            @foreach($order_items as $item)
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
                                                                        ({{ isset($provider->phone)? $provider->phone : "no phone" }})
                                                                        <br>
                                                                        {{ isset($provider->email)? $provider->email : null }}<br>
                                                                        {{ isset($provider->direction)? $provider->direction : null }}<br>
                                                                        {{ isset($provider->district)? $provider->district : null }}
                                                                        {{ isset($provider->city)? $provider->city : null }}
                                                                        {{ isset($provider->street)? $provider->street : null }}<br>
                                                                        {{ isset($provider->address)? $provider->address : null }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $item->status }}
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
