<!DOCTYPE html>
<html lang="en">
<head>
	<title>Exploor.pe Ticket</title>

	<!-- BEGIN META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="your,keywords">
	<meta name="description" content="Short explanation about this website">
	<!-- END META -->

</head>
<body>
<table style="width: 100%; margin: auto;">
	<thead>
	<tr>
		<th style="width: 100%; height: 50px; background: #121528; text-align: left;">
			<img src="{{ $message->embed('assets/images/email-temp-08.png') }}" style="height:100%">
		</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td style="text-align: center; font-family: Arial; position: relative;">
                        <span style="position: absolute; display: block; width: 100%;">
                            <h2 style="font-size: 3.5vw; padding: 1vw 0; margin: 0; color: #f39200;">Welcome to exploor</h2>
                            <h4 style="font-size: 2vw; padding: 0.2vw 0; margin: 0;">exploor helps you to discover the greatest experiences in Peru in a<br> simple and secure way.</h4>
                        </span>
			{{--{{ $message->embed('assets/images/sign-banner.png') }}--}}
			<img src="{{ $message->embed('assets/images/sign-banner.png') }}" style="width: 100%">
		</td>
	</tr>
	<tr>
		<td style="font-size: 1.75vw; padding: 0.2vw 0; padding:3vw 0; font-family: Arial; text-align: center">
			Confirm your account now to checkout faster and receive unique offers.
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
			<a href="{{ URL::route('getActivate', $code) }}"><img src="{{ $message->embed('assets/images/confirm-button.png') }}" style="height: 8vw"></a>
		</td>
	</tr>
	<tr>
		<td style="font-size: 1.5vw; padding: 0.2vw 0; padding:3vw 0; font-family: Arial; text-align: center">
			For tips and inspiration, check out our <a href="http://www.exploor.pe" style="color: #1e70b7; text-decoration: none;">website</a> and our <a href="#" style="color: #1e70b7; text-decoration: none;">blog</a>
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
			<a href="https://www.instagram.com/" target="_blank"><img src="{{ $message->embed('assets/images/social-1.png') }}" style="height: 4vw"></a>
			<a href="https://www.facebook.com/" target="_blank"><img src="{{ $message->embed('assets/images/social-2.png') }}" style="height: 4vw"></a>
			<a href="https://twitter.com/" target="_blank"><img src="{{ $message->embed('assets/images/social-3.png') }}" style="height: 4vw"></a>
		</td>
	</tr>
	</tbody>
	<tfoot style="width: 100%; height: auto; background: orange; text-align: center; font-family: Arial;">
	<tr>
		<td style="padding: 3% 0 !important; font-size: 1vw;">
			If you have not made this transaction please contact us under <span style="color: #1e70b7; text-decoration: none;">info@exploor.pe</span><br>You received this mail from exploor (Exploor.pe S.A.C) because you registered on <br> <a href="http://www.exploor.pe" style="color: #1e70b7; text-decoration: none;">www.exploor.pe</a> with this email address.<br>Avenida Aviacion 4004 Districto de Surquillo, Lima, Peru.
		</td>
	</tr>
	</tfoot>
</table>
</body>
</html>




{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
	{{--<meta charset="utf-8">--}}
	{{--<title>Wayna</title>--}}
	{{--<meta name="description" content="Wayna">--}}
	{{--<meta name="author" content="Wayna">--}}
{{--</head>--}}
{{--<style>--}}
	{{--h1 {--}}
		{{--color: #ff9528;--}}
	{{--}--}}
	{{--a,--}}
	{{--a:hover,--}}
	{{--a:focus--}}
	{{--{--}}
		{{--color:white !important;--}}
		{{--text-decoration:none;--}}
	{{--}--}}
	{{--#publicidad {--}}
		{{--width:75%;--}}
	{{--}--}}
	{{--@media (max-width: 600px) {--}}
		{{--table {--}}
			{{--width:100%--}}
		{{--}--}}
		{{--#publicidad {--}}
			{{--width: 100%;--}}
		{{--}--}}
	{{--}--}}
{{--</style>--}}
{{--<body>--}}
	{{--<div style="background-color: #D6D6D6;padding:10px">--}}
		{{--<table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-family:verdana;">--}}
			{{--<tr>--}}
				{{--<td style="text-align:center;">--}}
					{{--<a href="https://wayna.com.pe">--}}
						{{--<img src="https://www.wayna.com.pe/images/logo_mail.png" alt="Wayna-logo">--}}
					{{--</a>--}}
				{{--</td>--}}
			{{--</tr>--}}
			{{--<tr>--}}
				{{--<td>&nbsp;</td>--}}
			{{--</tr>--}}
			{{--<tr>--}}
				{{--<td style="text-align:center;background-color: white; padding: 0 20px ">--}}
					{{--<table width="100%" cellpadding="0" cellspacing="0">--}}
						{{--<tr>--}}
							{{--<td>--}}
								{{--<p>--}}
									{{--<h1>¡Felicidades!</h1>--}}
								{{--</p>--}}
							{{--</td>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<td>--}}
								{{--<p>Ahora eres parte de mundo de actividades Wayna, podrás disfrutar de nuevas experiencias que recordaras para siempre.--}}
								{{--</p>--}}
								{{--<p>Solo debes activar tu cuenta dando clic en el siguiente botón:--}}
								{{--</p>--}}
							{{--</td>--}}
						{{--</tr>--}}
						{{--<tr>--}}
							{{--<td style="font-size:14px;">--}}
							    {{--<p><a href="{{ URL::route('getActivate', $code) }}" class="btn btn-warning">Activar cuenta</a></p>--}}
								{{--<p>--}}
									{{--Saludos,<br>--}}
									{{--Equipo de wayna.--}}
								{{--</p>--}}
							{{--</td>--}}
						{{--</tr>--}}
					{{--</table>--}}
				{{--</td>--}}
			{{--</tr>--}}
			{{--<tr>--}}
				{{--<td>--}}
					{{--<table width="100%" cellpadding="0" cellspacing="0">--}}
						{{--<tr>--}}
							{{--<td style="color:white;font-size:13px;text-align:center;padding:10px">--}}
								{{--<p>--}}
									{{--<a href="http://wayna.com.pe">http://wayna.com.pe</a>--}}
								{{--</p>--}}
								{{--<p>--}}
									{{--<a href="https://www.facebook.com/waynaexp/">--}}
										{{--<img src="https://wayna.com.pe/images/fb_ic.png">--}}
									{{--</a>--}}
									{{--<a href="https://twitter.com/waynaexp">--}}
										{{--<img src="https://wayna.com.pe/images/tw_ic.png">--}}
									{{--</a>--}}
									{{--<a href="https://www.instagram.com/waynaexp/">--}}
										{{--<img src="https://wayna.com.pe/images/ig_ic.png">--}}
									{{--</a>--}}
								{{--</p>--}}
								{{--<p>--}}
									{{--&copy; Todos los derechos reservados 2016--}}
								{{--</p>--}}
							{{--</td>--}}
						{{--</tr>--}}
					{{--</table>--}}
				{{--</td>--}}
			{{--</tr>--}}
		{{--</table>--}}
	{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
