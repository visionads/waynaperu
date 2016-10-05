@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="sample-table-2">
                <thead>
                <tr>

                    <th class="hidden-xs">Order Number</th>
                    <th class="hidden-xs">Order Status</th>
                    <th class="hidden-xs">Order Price</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $lang_count	= count($orders);
                ?>
                @if($lang_count > 0)

                    @foreach ($orders as $order)
                        <tr>

                            <td><a href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>">{{ $order->order_number }}</a></td>
                            <td>{{ $order->status }}</td>
                            <td>s./ <?php echo sprintf('%.2f', $order->price / 100); ?></td>

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
    <?php echo $orders->links(); ?>
</div>
@stop