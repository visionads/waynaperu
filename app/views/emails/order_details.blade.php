<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Details Email</title>
</head>

<body>
    <style>
        table {}
        table td, table th { padding: 3px; text-align: left; font-size: 14px;}
        fieldset { margin: 0 !important; padding: 2%;}
        fieldset legend { border: 1px solid #909090 !important; padding:5px 8px;}
    </style>
    <div style="width: 90%; margin: 0 auto !important; background: #f0f0f0; padding: 2%;">
        <p style="background: #e0e0e0; padding: 10px;">
            Dear Sir / Dear Madam,<br><br>
            Your Product details is given bellow :
        </p>
        <h4 style="color: #0a6ebd; font-size: 20px;">{{ trans('text.order_details') }}</h4>
        <fieldset style="border: 1px solid #909090; float: left; width: 45%; height: 170px;">
            <legend style="text-align:center; font-size:16px; font-weight:bold;">Order</legend><br><br>
            <table border="0">
                <tr>
                    <td>Order Number</td>
                    <td>:</td>
                    <th>{{ $order->order_number }}</th>
                </tr>
                <tr>
                    <td>Order Status</td>
                    <td>:</td>
                    <th align="left">{{ $order->status }}</th>
                </tr>
                <tr>
                    <td>Total Qty</td>
                    <td>:</td>
                    <th align="left">{{ $order->qty }}</th>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>:</td>
                    <th align="left">s./ <?php echo sprintf('%.2f', $order->price / 100); ?></th>
                </tr>
            </table>
        </fieldset>

        <fieldset style="border: 1px solid #909090; float: right; width: 45%; height: 170px;">
            <legend style="text-align:center; font-size:16px; font-weight:bold;">User</legend>
            @if($order->user_id == NULL)
                <p>This Order is by guest user and You can get his details on "Order Items" section.</p>
            @else
                <?php $user = getUserInfo($order->user_id);?>
                <table border="0">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <th>
                            @if($user->first_name != '' || $user->last_name != '' )
                                <strong style="line-height:42px;">{{ $user->first_name }} {{ $user->last_name }}</strong>
                            @else
                                <strong style="line-height:42px;">User didn't add his Name</strong>
                            @endif
                        </th>
                    </tr>
                    <tr><td>Email</td><td>:</td><th align="left">{{ $user->email }}</th></tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <th align="left">
                            @if($user->direction != '')
                                <strong >#{{ $user->flat }}, {{ $user->direction }}<br/> {{ $user->city }}, {{ $user->district }}<br/>{{ $user->province }} </strong>
                            @else
                                <strong style="line-height:42px;">User Didn't add his address. </strong>
                            @endif
                        </th>
                    </tr>
                    <tr><td>Total Price</td><td>:</td><th align="left">s./ <?php echo sprintf('%.2f', $order->price / 100); ?></th></tr>
                </table>
            @endif
        </fieldset>

        <div style="clear: both !important;">&nbsp;</div>

        <fieldset style="border: 1px solid #909090; width: 98%">
            <legend style="text-align:center; font-size:16px; font-weight:bold;">Order Items</legend>
            @foreach($order_items as $item)
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <fieldset style="border:0; border-top: 1px solid #909090; width:auto;">
                        <legend style="border: 0px solid #909090; padding:5px;">{{ getExpName($item->product_id) }} -<small>{{ getLocName($item->loc_id) }}</small></legend>

                        <table border="0">
                            <tr><td>PDF Qty</td><td>:</td><th>{{ $item->pdf_qty }}</th></tr>
                            <tr><td>PDF Price</td><td>:</td><th align="left">s./ {{ $item->pdf_price }}</th></tr>
                            <tr><td>Mail Qty</td><td>:</td><th align="left">{{ $item->mail_qty }}</th></tr>
                            <tr><td>Mail Price</td><td>:</td><th align="left"> s./ {{ $item->mail_price }}</th></tr>
                            <tr><td>Gift Qty</td><td>:</td><th align="left">{{ $item->gift_qty }}</th></tr>
                            <tr><td>Gift Price</td><td>:</td><th align="left"> s./ {{ $item->gift_price }}</th></tr>
                        </table>

                        <div>
                            <?php $details = json_decode($item->details);
                                //  echo "<pre>";print_r($details);die;
                            ?>
                            @if(count($details)>0)
                                @foreach($details as $key => $detail)
                                    <?php  //echo "<pre>";print_r($detail);die; ?>
                                    @if($key == 'pdf')
                                    <h6>PDF:</h6>
                                    @endif
                                    @if($key == 'mail')
                                    <h6>MAIL:</h6>
                                    @endif
                                    @if($key == 'gift')
                                    <h6>GIFT:</h6>
                                    @endif
                                    @foreach($detail as $k => $v)
                                    @if($key == 'pdf')
                                    <?php $count = 1; ?>
                                    @foreach($v as $i => $j)
                                        <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                        <?php $count++; ?>
                                    @endforeach
                                    <hr>
                                    @endif
                                    @if($key == 'mail')
                                        <?php $count = 1; ?>
                                        @foreach($v as $i => $j)
                                            <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                            <?php $count++; ?>
                                        @endforeach
                                        <hr>
                                    @endif
                                    @if($key == 'gift')
                                        <?php $count = 1; ?>
                                        @foreach($v as $i => $j)
                                            <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                            <?php $count++; ?>
                                        @endforeach
                                        <hr>
                                    @endif
                                @endforeach
                                @endforeach
                            @endif
                        </div>

                    </fieldset>
                </div>
            @endforeach
        </fieldset>
    </div>

</body>
</html>
        <!-- Page Content -->


