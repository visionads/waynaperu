@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
    <p>
        <a class="link btn btn-warning" href="{{ URL::to('profile') }}"><i class="fa fa-arrow-left"></i> Back</a>

        <b> Providers Order List</b>
    </p>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="datatable1">
                <thead>
                <tr>

                    <th class="hidden-xs">Order ID</th>
                    <th class="hidden-xs">Order Number</th>
                    <th class="hidden-xs">Order Status</th>
                    <th class="hidden-xs">Order Price</th>
                    <th class="hidden-xs">Order Qty</th>
                    <th> Action </th>

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
                                    <b>Details </b>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div>No Order found</div>
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