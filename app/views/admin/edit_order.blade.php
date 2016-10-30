@extends('admin.layout')
@section('content')


    <p>
        @if(Auth::user()->type=='provider')
            <a class="link btn btn-warning" href="{{ URL::to('orders/provider/'.Auth::id()) }}"><i class="fa fa-arrow-left"></i> {{ trans('provider.back_to_order_list') }}</a>
        @else
            <a class="link btn btn-warning" href="{{ URL::to('admin/orders') }}"><i class="fa fa-arrow-left"></i> {{ trans('provider.back_to_order_list') }}</a>
        @endif
    </p>


    <div class="row">
    <div class="card">
        <div class="card-body">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{ trans('provider.order') }}</legend>
                    {{ Form::open(array('route' => 'update_order','class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_number') }}:</label>
                        <div class="col-sm-12 col-md-8">
                            <strong style="line-height:42px;">
                                {{ $order->order_number }}
                            </strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_status') }}:</label>
                        <div class="col-sm-12 col-md-8">
                            <strong style="line-height:42px;">
                                {{ $order->status }}
                            </strong>
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="status" class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_status') }}:</label>--}}
                        {{--<div class="col-sm-12 col-md-8">--}}
                            {{--{{Form::select('status', array('PENDING' => 'Pending', 'SUCCESS' => 'Success', 'SHIPPED' => 'Shipped'), $order->status, ['class' => 'form-control'])}}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.total_qty') }}:</label>
                        <div class="col-sm-12 col-md-8">
                            <strong style="line-height:42px;">{{ isset($order->qty)?$order->qty:null }}</strong>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.total_price') }}:</label>
                        <div class="col-sm-12 col-md-8">
                            <strong style="line-height:42px;">s./ {{number_format($order->price,2)}}</strong>
                        </div>
                    </div>
                    <div class="form-actions">
                        @if(Auth::user()->type=='admin' && $order->status != 'SUCCESS')
                            <a class="btn btn-success pull-right" href="{{ route('ticket',$order->id) }}"><b>Send Ticket</b></a>
{{--                            {{ Form::submit('Update Order', $attributes = ['class' => 'btn btn-success pull-right']) }}--}}
                        @endif
                    </div>
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    {{ Form::close() }}
                </fieldset>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{ trans('provider.clients_info') }}</legend>
                    @if($order->user_id == NULL)
                        <p>{{ trans('provider.this_order_is_by_guest') }}</p>
                    @else
                        <?php
                            $user = getUserInfo($order->user_id);
                        ?>
                        <div class="form-group">
                            <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.name') }}:</label>
                            <div class="col-sm-12 col-md-8">
                                @if($user->first_name != '' || $user->last_name != '' )
                                    <strong style="line-height:42px;">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </strong>
                                @else
                                    <strong style="line-height:42px;">
                                        {{ trans('provider.user_has_no_name') }}
                                    </strong>
                                @endif
                            </div>
                        </div>
                        <div style="clear:both"></div>
                        @if(Auth::user()->type=='admin')
                            <div class="form-group">
                                <label  class="col-sm-12 col-md-4 control-label">
                                    {{ trans('provider.email') }}:
                                </label>
                                <div class="col-sm-12 col-md-8">
                                    <strong style="line-height:42px;">
                                        {{ $user->email }}
                                    </strong>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="form-group">
                                <label  class="col-sm-12 col-md-4 control-label">{{ trans('provider.address') }}:</label>
                                <div class="col-sm-12 col-md-8">
                                    @if($user->direction != '')
                                        <strong >#{{ $user->flat }}, {{ $user->direction }}<br/> {{ $user->city }}, {{ $user->district }}<br/>{{ $user->province }} </strong>
                                    @else
                                        <strong style="line-height:42px;">{{ trans('provider.user_has_no_address') }} </strong>
                                    @endif
                                </div>
                            </div>
                        @endif
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
                                <th> {{ trans('provider.created_at') }} </th>
                                <th> {{ trans('provider.provider_info') }} </th>
                                <th> {{ trans('provider.use_product') }}</th>
                            </tr>

                        </thead>
                        <tbody>
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
                                <td> {{ isset($item->created_at)?$item->created_at: null }} </td>
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
                                    @if($item->status=='used')
                                        {{ trans('provider.used') }}

                                    @elseif(Auth::user()->type=='admin' || ($item->status=='new' && $item->user_id==Auth::user()->id))
                                        {{ Form::open(['route'=>'submit-ticket']) }}
                                        <input name="order_item_id" type="hidden" value="{{ $item->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">
                                        <input name="order_id" type="hidden" value="{{ $order->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">
                                        <div class="input-group">
                                            <input required name="ticket_number" type="text" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit">{{ trans('provider.go') }}!</button>
                                              </span>
                                        </div><!-- /input-group -->
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($tickets)>0)
                        <div class="row">
                        @foreach($tickets as $ticket)
                            @if(Auth::user()->type=='admin')
                                <div class="col-md-6">
                                    @if(file_exists(public_path('assets/tickets/'.$ticket->ticket_number.'.jpg')))
                                    <img width="80%" src="{{ asset('assets/tickets/'.$ticket->ticket_number.'.jpg') }}" alt="">
                                    @else
                                    <img width="80%" src="{{ asset('assets/images/default-ticket.png'); }}" alt="">

                                    @endif
                                    <br>
                                    <b>{{ trans('provider.ticket_number') }} - </b>{{ $ticket->ticket_number }}
                                </div>
                            @else
                                <div class="col-md-6">

                                    @if(file_exists(public_path('assets/tickets/P-'.$ticket->ticket_number.'.jpg')))
                                        <img width="80%" src="{{ asset('assets/tickets/P-'.$ticket->ticket_number.'.jpg') }}" alt="">
                                    @else
                                        <img width="80%" src="{{ asset('assets/images/default-ticket.png'); }}" alt="">

                                    @endif
                                    <br>
                                    <b>{{ trans('provider.ticket_number') }} - </b>{{ substr($ticket->ticket_number,0,-4).'****' }}
                                </div>
                            @endif
                        @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
    </div>
</div>
@stop