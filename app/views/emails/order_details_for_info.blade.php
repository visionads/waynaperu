<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oreder details for info@exploor.pe</title>
</head>
<body>
<div style="padding: 10px 0;">{{ trans('pi.confirmation_number') }} : <span style="color: orange;">{{ $order->order_number }}</span></div>
<table style="width: 100%; border-bottom: 1px solid orange; border-left: 1px solid orange; margin-bottom: 15px;" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.activity') }}</th>
        <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.location') }}</th>
        <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.quantity') }}</th>
        <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.price') }}</th>
    </tr>
    </thead>
    <tbody>
    <?php $x=1;
    $total=0;
    ?>
    @foreach($order_items as $order_item)
        <tr>
            <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->title }}</td>
            <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->city.', '.$order_item->district }}</td>
            <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->mail_qty+$order_item->pdf_qty }}</td>
            <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">S/.{{ $order_item->mail_price+$order_item->pdf_price }}</td>
        </tr>
    <?php $total+= ($order_item->mail_price*$order_item->mail_qty)+($order_item->pdf_price*$order_item->pdf_qty); ?>
    @endforeach
    <tr>
        <td colspan="3" style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: right">Total</td>
        <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $total }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>