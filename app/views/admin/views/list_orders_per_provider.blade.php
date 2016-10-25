@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
    <p>
        <a class="link btn btn-warning" href="{{ URL::to('profile/'.$provider_id) }}"><i class="fa fa-arrow-left"></i> {{ trans('provider.back') }}</a>

        <b> {{ trans('provider.providers_order_list') }}</b>
    </p>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="datatable1">
                <thead>
                <tr>

                    <th class="hidden-xs">{{ trans('provider.order_ID') }}</th>
                    <th class="hidden-xs">{{ trans('provider.order_number') }}</th>
                    <th class="hidden-xs">{{ trans('provider.order_status') }}</th>
                    <th class="hidden-xs">{{ trans('provider.order_price') }}</th>
                    <th class="hidden-xs">{{ trans('provider.order_qty') }}</th>
                    <th> {{ trans('provider.action') }} </th>

                </tr>
                </thead>
                <tbody>
                <?php
                    $lang_count	= count($orders);
                ?>
                @if($lang_count > 0)
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>">
                                    <b>{{ isset($order->id)?$order->id:null }} </b>
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>">
                                    <b>{{ isset($order->order_number)?$order->order_number:null }} </b>
                                </a>
                            </td>
                            <td>{{ isset($order->status)?$order->status:null }}</td>
                            <td>s./ <?php echo sprintf('%.2f', isset($order->price)?$order->price:100 / 100); ?></td>
                            <td>{{ isset($order->qty)?$order->qty:null }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>">
                                    <b>{{ trans('provider.details') }} </b>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div>{{ trans('provider.no_order_found') }}</div>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <?php //echo $orders->links(); ?>
</div>
@stop