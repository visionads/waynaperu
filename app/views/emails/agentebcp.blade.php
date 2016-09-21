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
					        		¡{{ trans('text.thanks') }} <span style="color:#d39010">{{ $name }}</span>!
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
					<table border="0" cellpadding="0" cellspacing="0" align="center" style="background-color:white;padding: 5px;border:1px solid #DEDEDE;margin-top:10px;width: 100%;">
					    <tr>
					        <td align="center" style="padding:10px;">
					            <h2>
					            	<span>Detalle de pago por Agente BCP</span>
					            </h2>
					        </td>
					    </tr>
				    	<tr>
				    		<td align="center">
				    			<h3>{{ trans('text.total') }}: S/.{{ number_format($price, 2) }}</h3>
				    			<p>
				    				<strong>(BCP)</strong><span>193-2298769-0-86</span>
				    			</p>
				    		</td>
				    	</tr>
					    <tr>
					    	<td align="center" style="font-size: 12px;">
					    		<ul style="list-style:none;display:inline-block;width: 100%;padding:0;">
					    			<li style="display:inline-block;width:20%;vertical-align:top;">
					    				<img src="https://wayna.com.pe/images/bcpagente128.png" alt="payment" width="96" border="0">
					    				<p style="padding: 5px 10px;">Acercate a un Agente BCP</p>
					    			</li><li style="display:inline-block;width:20%;vertical-align:top;">
					    				<img src="https://wayna.com.pe/images/transfiere128.png" alt="payment" width="96" border="0">
					    				<p style="padding: 5px 10px;">Transfiere el monto indicado al número de cuenta</p>
					    			</li><li style="display:inline-block;width:20%;vertical-align:top;">
					    				<img src="https://wayna.com.pe/images/comprobante128.png" alt="payment" width="96" border="0">
					    				<p style="padding: 5px 10px;">Envía una foto del comprobante a<br><a href="mailto:finanzas@waynaperu.com" style="color:#d39010;font-size:12px;">finanzas@waynaperu.com</a></p>
					    			</li><li style="display:inline-block;width:20%;vertical-align:top;">
					    				<img src="https://wayna.com.pe/images/ticket128.png" alt="payment" width="96" border="0">
					    				<p style="padding: 5px 10px;">Recibir el ticket</p>
					    			</li><li style="display:inline-block;width:20%;vertical-align:top;">
					    				<img src="https://wayna.com.pe/images/regala128.png" alt="payment" width="96" border="0">
					    				<p style="padding: 5px 10px;">Disfruta el momento o regala un recuerdo inolvidable a otra persona.</p>
					    			</li>
					    		</ul>
					    	</td>
					    </tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" align="center" style="background-color:white;padding: 5px;border:1px solid #DEDEDE;margin-top:10px;margin-bottom:20px;width: 100%;">
					    <tr>
					        <td align="center" style="padding:10px;">
					            <h3 style="margin-bottom:0;">
					            	<span>¿Preguntas?</span><br>
									<img src="https://wayna.com.pe/images/question64.png" alt="questions" width="64" border="0">
					            </h3>
					        </td>
					    </tr>
					    <tr>
					    	<td align="center" style="font-size:13px;">
					    		<p>
					    			En caso tengas alguna pregunta, envienos un correo a: <a href="mailto:info@waynaperu.com" style="color:#d39010">info@waynaperu.com</a> y<br>
									nosotros lo contactaremos tan pronto sea posible
					    		</p>
					    		<p style="line-height:40px;">
					    			También puedes contactarnos 24/7 en <a href="https://www.facebook.com/waynaexp/" target="_blank" style="text-decoration:none;color:#d39010;"><img src="https://wayna.com.pe/images/orange-facebook32.png" alt="facebook" width="24" style="display:inline-block;vertical-align: middle;">/waynaexp</a>
					    		</p>
					    	</td>
					    </tr>
					    <tr>
					    	<td align="center" style="font-size:13px;padding:20px;">
					    		<h3>Siguenos en</h3>
					    		<div>
					    			<a href="https://www.facebook.com/waynaexp/" target="_blank" style="text-decoration:none;">
					    				<img src="https://wayna.com.pe/images/facebook72.png" alt="facebook" width="64" border="0">
					    			</a>
					    			<a href="https://twitter.com/waynaexp" target="_blank" style="text-decoration:none;">
					    				<img src="https://wayna.com.pe/images/twitter72.png" alt="facebook" width="64" border="0">
					    			</a>
					    			<a href="https://www.instagram.com/waynaexp/" target="_blank" style="text-decoration:none;">
					    				<img src="https://wayna.com.pe/images/instagram72.png" alt="facebook" width="64" border="0">
					    			</a>
					    		</div>
					    	</td>
					    </tr>
					    <tr>
					    	<td align="center" style="font-size:13px;">
					    		<p style="margin-bottom:20px;">
					    			Si usted no realizo esta transacción, por favor contáctenos por <a href="mailto:info@waynaperu.com" style="color:#d39010;">info@waynaperu.com</a><br>
					    			Usted ha recibido este correo de Wayna Perú S.A.C., porque se ha registrado en <br>
					    			<a href="www.wayna.com.pe" target="_blank" style="color:#d39010;">www.wayna.com.pe</a> con esta dirección de correo.
					    		</p>
					    	</td>
					    </tr>
					</table>
		        </td>
		    </tr>
		</table>
	</body>
</html>
