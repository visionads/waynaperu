<html>
	<head>
		<title>Confirmación de Pedido</title>
	</head>
    <body style="background-color:#ebf0f1;font-family:verdana;font-size:13px;color:#666">
		<table border="0" cellpadding="0" cellspacing="0" align="center" style="padding: 5px;width: 800px;">
		    <tr>
		        <td>
					<table border="0" cellpadding="0" cellspacing="0" align="center" style="background-color:white;padding: 5px;border:1px solid #DEDEDE;width: 100%;">
					    <tr>
					        <td>
					            <img src="http://wayna.com.pe/images/mail_header800x200.jpg" width="800" alt="logo">
					        </td>
					    </tr>
					    <tr>
					        <td align="center">
					        	<h1 style="margin: 20px 0;">
					        		¡{{ trans('text.buying') }} <span style="color:#d39010">{{ $name }}</span>!
					        	</h1>
					        	<p style="margin-bottom:10px;font-size:18px;">
				        			<span>{{ trans('text.confirmation_number') }}:</span>
				        			<strong style="color:#d39010">{{ $order_number }}</strong>
					        	</p>
					        </td>
					    </tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" align="center" style="background-color:white;padding: 5px;border:1px solid #DEDEDE;margin-top:10px;width: 100%;">
						<tr>
							<td colspan="5" align="center">
								<h2>{{ trans('text.order_details') }}</h2>
							</td>
						</tr>
						<tr>
							<td style="padding: 10px"><strong>{{ trans('text.activity') }}</strong></td>
							<td style="padding: 10px"><strong>{{ trans('text.location') }}</strong></td>
							<td style="padding: 10px"><strong>{{ trans('text.quantity') }}</strong></td>
							<td style="padding: 10px"><strong>{{ trans('text.type') }}</strong></td>
							<td style="padding: 10px"><strong>{{ trans('text.price') }}</strong></td>
						</tr>
						@foreach($orders as $order)
						<tr>
							<td style="padding: 10px">{{ getExpName($order->product_id) }}</td>
							<td style="padding: 10px">{{ getLocationName($order->product_id) }}</td>
							<td style="padding: 10px">{{ $order->qty }}</td>
							<td style="padding: 10px">@if($order->pdf_qty > 0) PDF ticket @endif
								@if($order->mail_qty > 0) MAIL ticket @endif
								@if($order->gift_qty > 0) GIFT ticket @endif
							</td>
							<td style="padding: 10px">S/.{{ number_format(($order->pdf_price + $order->mail_price + $order->gift_price), 2) }}</td>
						</tr>
						@endforeach
					</table>
		        </td>
		    </tr>
		</table>
	</body>
</html>
