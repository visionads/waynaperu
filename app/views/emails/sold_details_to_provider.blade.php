<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket</title>
</head>
<body>

Dear Sir / Dear Madam,
<br>
A new product has been sold.
<table>
    <tr>
        <th>Product Id</th>
        <td>{{ $product_id }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td>{{ $title }}</td>
    </tr>
    <tr>
        <th>Adult Quantity</th>
        <td>{{ $pdf_qty }}</td>
    </tr>
    <tr>
        <th>Boy Quantity</th>
        <td>{{ $mail_qty }}</td>
    </tr>
    <tr>
        <th>Total Quantity</th>
        <td>{{ $pdf_qty+$mail_qty }}</td>
    </tr>
    <tr>
        <th>Adult Price</th>
        <td>{{ $pdf_price }}</td>
    </tr>
    <tr>
        <th>Boy Price</th>
        <td>{{ $mail_price }}</td>
    </tr>
    <tr>
        <th>Gift Percentage (%)</th>
        <td>{{ $gift_price }}</td>
    </tr>
    <tr>
        <th>Total Price</th>
        @if(isset($gift_price) && $gift_price != 0.00)
            <td>{{ ($pdf_price-(($pdf_price/100))*$gift_price)+($mail_price-(($mail_price/100))*$gift_price) }}</td>
        @else
            <td>{{ ($pdf_price*$pdf_qty)+($mail_price*$mail_qty) }}</td>

        @endif
    </tr>
</table>

</body>
</html>