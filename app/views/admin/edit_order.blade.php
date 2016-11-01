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
                    <b>{{ trans('provider.order_number') }} :</b> {{ $order->order_number }}
                    <br><b>{{ trans('provider.order_status') }} :</b> {{ $order->status }}
                    <br><b>{{ trans('provider.total_qty') }} :</b> {{ isset($order->qty)?$order->qty:null }}
                    <br><b>{{ trans('provider.total_price') }} :</b> s./ {{number_format($order->price,2)}}
                    {{ Form::open(array('route' => 'update_order','class' => 'form-horizontal')) }}
                    {{--<div class="form-group">--}}
                        {{--<label for="status" class="col-sm-12 col-md-4 control-label">{{ trans('provider.order_status') }}:</label>--}}
                        {{--<div class="col-sm-12 col-md-8">--}}
                            {{--{{Form::select('status', array('PENDING' => 'Pending', 'SUCCESS' => 'Success', 'SHIPPED' => 'Shipped'), $order->status, ['class' => 'form-control'])}}--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
                            <b>{{ trans('provider.name') }} : </b>
                                @if($user->first_name != '' || $user->last_name != '' )
                                        {{ $user->first_name }} {{ $user->last_name }}
                                @else
                                    <strong style="line-height:42px;">
                                        {{ trans('provider.user_has_no_name') }}
                                    </strong>
                                @endif
                        {{--@if(Auth::user()->type=='admin')--}}
                                    <br><b>{{ trans('provider.email') }} : </b>
                                        {{ $user->email }}
                                    <br><b>{{ trans('provider.telephone') }} : </b>
                                        {{ $user->phone }}
                            <br><b>{{ trans('provider.address') }}  </b>
                                    @if($user->direction != '')
                                        <strong >#{{ $user->flat }}, {{ $user->direction }}<br/> {{ $user->city }}, {{ $user->district }}<br/>{{ $user->province }} </strong>
                                    @else
                                        <strong style="line-height:42px;">{{ trans('provider.user_has_no_address') }} </strong>
                                    @endif
                        {{--@endif--}}
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
                                <th> {{ trans('provider.price') }} </th>
                                <th> {{ trans('provider.quantity') }} </th>
                                <th> {{ trans('provider.created_at') }} </th>
                                <th> {{ trans('provider.provider_info') }} </th>
                                <th> {{ trans('provider.contact_info') }} </th>
                                <th> {{ trans('provider.ticket_number') }} </th>
                                <th> {{ trans('provider.use_product') }}</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach($order_items as $item)
                            <tr>
                                <td>
                                    <b>{{ trans('provider.product_id') }} : </b>
                                    {{ $item->id }}<br>
                                    <?php
                                    $product_content = getProductContentPerProductId($item->product_id);
                                    ?>
                                    {{ isset($product_content->title)?$product_content->title: null }}
                                    <br>
                                    Location -

                                        <?php $loc_name = getLocName($item->loc_id); ?>
                                        {{ isset($loc_name)?$loc_name: null }}
                                    <br><b>{{ trans('provider.type_of_payment') }} : </b>
                                    {{ isset($item->type_of_payment)?$item->type_of_payment: null }}
                                </td>
                                <td>
                                    <b>{{ trans('provider.adult_price') }} : </b>
                                    s./ {{ isset($item->pdf_price)?$item->pdf_price: null }}
                                    <br><b>{{ trans('provider.child_price') }} : </b>
                                    s./ {{ isset($item->mail_price)?$item->mail_price  : null }}
                                    <br><b>{{ trans('provider.gift_price') }} : </b>
                                    s./ {{ isset($item->gift_price)?$item->gift_price: null }}
                                </td>
                                <td>
                                    <b>{{ trans('provider.adult_qty') }} : </b>
                                    {{ isset($item->pdf_qty)?$item->pdf_qty: null }}
                                    <br><b>{{ trans('provider.child_qty') }} : </b>
                                    {{ isset($item->mail_qty)?$item->mail_qty: null }}
                                    <br><b>{{ trans('provider.gift_qty') }} : </b>
                                    {{ isset($item->gift_qty)?$item->gift_qty: null }}
                                </td>
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
                                    {{ trans('provider.provider_id').' : ' }} {{ isset($provider->id)? $provider->id : null }}<br>
                                    {{ trans('provider.provider_name') }} :
                                    {{ isset($provider->first_name)? $provider->first_name : null }}
                                    {{ isset($provider->last_name)? $provider->last_name : null }}<br>
                                        {{ isset($provider->phone)? '<br>('.$provider->phone.')' : "" }}

                                </td>
                                <td>
                                    <b>{{ trans('provider.person_in_charge') }} :</b> {{ $item->incharge }}<br>
                                    <b>{{ trans('provider.telephone') }} :</b>

                                    <?php
                                    if($item->user_id !=0)
                                    {
                                        $user_phone_numbers = getUserPhoneNumber($item->user_id);
                                    }else{
                                        $user_phone_numbers=[];
                                    }
                                    if(!empty($user_phone_numbers) && count($user_phone_numbers)>0){
                                        $h=1;
                                        $total=count($user_phone_numbers);
                                        foreach ($user_phone_numbers as $user_phone_number) {
                                            echo $user_phone_number->number;
                                            if($h<$total){
                                                echo ',';
                                            }
                                            $h++;

                                        }
                                    }
                                    //                                    dd($user_phone_numbers);
                                    ?>


                                    <br>
                                    <b>{{ trans('provider.email_provider') }} : </b>{{ isset($provider->email)? $provider->email : null }}<br>
                                    <b>{{ trans('provider.direction_provider') }} : </b>{{ isset($provider->direction)? $provider->direction : null }}<br>
                                    <b>{{ trans('provider.district') }} : </b>{{ isset($provider->district)? $provider->district : null }}<br>
                                    <b>{{ trans('provider.city') }} : </b>{{ isset($provider->city)? $provider->city : null }}<br>
                                    <b>{{ trans('provider.street') }} : </b>{{ isset($provider->street)? $provider->street : null }}<br>
                                    <b>{{ trans('provider.department') }} : </b>{{ isset($provider->department)? $provider->department : null }}
                                </td>
                                <td>
                                    {{ $item->ticket_number }}<br>

                                    <b>{{ trans('provider.status') }} : </b> {{ ucfirst($item->status) }}
                                </td>
                                <td>

                                    @if($item->status=='used')
                                            {{ trans('provider.date_of_activity_made').' <b>'.date('d M Y',strtotime($item->used_at)).'</b>' }}

                                    @elseif(Auth::user()->type=='admin' || ($item->status=='new' && $item->user_id==Auth::user()->id))
                                        {{ Form::open(['route'=>'submit-ticket']) }}
                                        <input name="order_item_id" type="hidden" value="{{ $item->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">
                                        <input name="order_id" type="hidden" value="{{ $order->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">
                                        <div class="input-group">
                                            <select class="form-control" name="status">
                                                <option value="unused" @if($item->status=='unused') selected @endif>{{ trans('provider.unused') }}</option>
                                                <option value="used" @if($item->status=='used') selected @endif>{{ trans('provider.used') }}</option>
                                            </select>
                                            <span class="input-group-btn">
                                                    <button class="btn btn-default" type="submit">{{ trans('provider.go') }}!</button>
                                                  </span>
                                        </div>
                                        {{ Form::close() }}
                                        {{--{{ Form::open(['route'=>'submit-ticket']) }}--}}
                                        {{--<input name="order_item_id" type="hidden" value="{{ $item->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">--}}
                                        {{--<input name="order_id" type="hidden" value="{{ $order->id }}" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">--}}
                                        {{--<div class="input-group">--}}
                                            {{--<select class="form-control" name="status">--}}
                                                {{--<option value="new">{{ trans('provider.unused') }}</option>--}}
                                                {{--<option value="used">{{ trans('provider.used') }}</option>--}}
                                            {{--</select>--}}
                                            {{--<span class="input-group-btn">--}}
                                                {{--<button class="btn btn-default" type="submit">{{ trans('provider.go') }}!</button>--}}
                                              {{--</span>--}}
                                        {{--</div>--}}
                                        {{--<!-- /input-group -->--}}
                                        {{--<div class="input-group">--}}
                                            {{--<input required name="ticket_number" type="text" class="form-control" placeholder="{{ trans('provider.enter_ticket_code') }}">--}}
                                            {{--<span class="input-group-btn">--}}
                                                {{--<button class="btn btn-default" type="submit">{{ trans('provider.go') }}!</button>--}}
                                              {{--</span>--}}
                                        {{--</div><!-- /input-group -->--}}
                                        {{--{{ Form::close() }}--}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($tickets)>0)
                        <div class="row">
                        @foreach($tickets as $ticket)
                                <div class="col-md-6">
                                    @if(file_exists(public_path('assets/tickets/'.$ticket->ticket_number.'.jpg')))
                                        <img width="80%" src="{{ asset('assets/tickets/'.$ticket->ticket_number.'.jpg') }}" alt="">
                                    @else
                                        <img width="80%" src="{{ asset('assets/images/default-ticket.png'); }}" alt="">

                                    @endif
                                    <br>
                                    <b>{{ trans('provider.ticket_number') }} - </b>{{ $ticket->ticket_number }}
                                </div>
                            {{--@if(Auth::user()->type=='admin')--}}
                                {{--<div class="col-md-6">--}}
                                    {{--@if(file_exists(public_path('assets/tickets/'.$ticket->ticket_number.'.jpg')))--}}
                                    {{--<img width="80%" src="{{ asset('assets/tickets/'.$ticket->ticket_number.'.jpg') }}" alt="">--}}
                                    {{--@else--}}
                                    {{--<img width="80%" src="{{ asset('assets/images/default-ticket.png'); }}" alt="">--}}

                                    {{--@endif--}}
                                    {{--<br>--}}
                                    {{--<b>{{ trans('provider.ticket_number') }} - </b>{{ $ticket->ticket_number }}--}}
                                {{--</div>--}}
                            {{--@else--}}
                                {{--<div class="col-md-6">--}}

                                    {{--@if(file_exists(public_path('assets/tickets/P-'.$ticket->ticket_number.'.jpg')))--}}
                                        {{--<img width="80%" src="{{ asset('assets/tickets/P-'.$ticket->ticket_number.'.jpg') }}" alt="">--}}
                                    {{--@else--}}
                                        {{--<img width="80%" src="{{ asset('assets/images/default-ticket.png'); }}" alt="">--}}

                                    {{--@endif--}}
                                    {{--<br>--}}
                                    {{--<b>{{ trans('provider.ticket_number') }} - </b>{{ substr($ticket->ticket_number,0,-4).'****' }}--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        @endforeach
                        </div>
                    @endif
                </fieldset>
            </div>
        </div>
    </div>
</div>
@stop