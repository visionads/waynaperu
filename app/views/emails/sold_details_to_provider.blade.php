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
<table>
    <tr>
        <th>Product Id/ Producto ID</th>
        <td>{{ $product_id }}</td>
    </tr>
    <tr>
        <th>Product / Producto</th>
        <td>{{ $title }}</td>
    </tr>
    <tr>
        <th>Adult Quantity / Cantidad Adulto</th>
        <td>{{ $pdf_qty }}</td>
    </tr>
    <tr>
        <th>Boy Quantity / Cantidad de niño</th>
        <td>{{ $mail_qty }}</td>
    </tr>
    <tr>
        <th>Total Quantity / Cantidad total</th>
        <td>{{ $pdf_qty+$mail_qty }}</td>
    </tr>
    <tr>
        <th>Adult Price / Precio Adulto</th>
        <td>{{ $pdf_price }}</td>
    </tr>
    <tr>
        <th>Boy Price / Precio Boy</th>
        <td>{{ $mail_price }}</td>
    </tr>
    <tr>
        <th>Gift Percentage (%) / Porcentaje de regalos (%)</th>
        <td>{{ $gift_price }}</td>
    </tr>
    <tr>
        <th>Total Price / Precio total</th>
        @if(isset($gift_price) && $gift_price != 0.00)
            <td>{{ ($pdf_price-(($pdf_price/100))*$gift_price)+($mail_price-(($mail_price/100))*$gift_price) }}</td>
        @else
            <td>{{ ($pdf_price*$pdf_qty)+($mail_price*$mail_qty) }}</td>

        @endif
    </tr>
</table>
<br>
IMPORTANTE: Por favor nunca brinda tu servicio a personas con códigos de exploor que no cumplen con los códigos te mandamos. Pueden ser bambas y códigos falsos.
<br>
Cualquier pregunta nos avisas por favor a info@exploor.pe o 986079739.
<br>
Muchas gracias y saludos,
<br>
Tu equipo de exploor

</body>
</html>