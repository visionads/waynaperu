@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">

    <h5>
        List of all order(s)
    </h5>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="datatable1">
                <thead>
                <tr>

                    <th class="hidden-xs">Order ID</th>
                    <th class="hidden-xs">Order Number</th>
                    <th class="hidden-xs">Clients Info </th>
                    <th class="hidden-xs">Order Status</th>
                    <th class="hidden-xs">Order Price</th>
                    <th> Qty</th>
                    <th> Created At</th>
                    <th> Actions </th>

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
                                    <b>{{ $order->id }}</b>
                                </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>">
                                    <b>{{ $order->order_number }}</b>
                                </a>
                            </td>
                            <td>
                                <?php
                                    $user = getUserInfo($order->user_id);
                                ?>
                                {{isset($user->first_name)?$user->first_name:null}}
                                {{isset($user->last_name)?$user->last_name:null}}<br>
                                {{isset($user->email)?$user->email:null}}
                            </td>
                            <td>{{ $order->status }}</td>
                            <td>s./ {{number_format($order->price, 2)}}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                @if(Auth::user()->type=='admin' && $order->status == 'PENDING')
                                    <a class="btn btn-info" href="{{ route('ticket',$order->id) }}"><b>Send Ticket</b></a>
                                @endif
                                <a class="btn btn-info" href="{{ URL::to('/') }}/admin/order/<?php echo $order->id; ?>"><b>Details</b></a>
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
    <?php echo $orders->links(); ?>
</div>
@stop