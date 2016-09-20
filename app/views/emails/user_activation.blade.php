<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Wayna</title>
	<meta name="description" content="Wayna">
	<meta name="author" content="Wayna">
</head>
<style>
	h1 {
		color: #ff9528;
	}
	a,
	a:hover,
	a:focus
	{
		color:white !important;
		text-decoration:none;
	}
	#publicidad {
		width:75%;
	}
	@media (max-width: 600px) {
		table {
			width:100%
		}
		#publicidad {
			width: 100%;
		}
	}
</style>
<body>
	<div style="background-color: #D6D6D6;padding:10px">
		<table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-family:verdana;">
			<tr>
				<td style="text-align:center;">
					<a href="https://wayna.com.pe">
						<img src="https://www.wayna.com.pe/images/logo_mail.png" alt="Wayna-logo">
					</a>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td style="text-align:center;background-color: white; padding: 0 20px ">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td>
								<p>
									<h1>¡Felicidades!</h1>
								</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Ahora eres parte de mundo de actividades Wayna, podrás disfrutar de nuevas experiencias que recordaras para siempre.
								</p>
								<p>Solo debes activar tu cuenta dando clic en el siguiente botón:
								</p>								
							</td>
						</tr>
						<tr>
							<td style="font-size:14px;">
							    <p><a href="{{ URL::route('getActivate', $code) }}" class="btn btn-warning">Activar cuenta</a></p>
								<p>
									Saludos,<br>
									Equipo de wayna.
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td style="color:white;font-size:13px;text-align:center;padding:10px">
								<p>
									<a href="http://wayna.com.pe">http://wayna.com.pe</a>
								</p>
								<p>
									<a href="https://www.facebook.com/waynaexp/">
										<img src="https://wayna.com.pe/images/fb_ic.png">
									</a>
									<a href="https://twitter.com/waynaexp">
										<img src="https://wayna.com.pe/images/tw_ic.png">
									</a>
									<a href="https://www.instagram.com/waynaexp/">
										<img src="https://wayna.com.pe/images/ig_ic.png">
									</a>
								</p>
								<p>
									&copy; Todos los derechos reservados 2016
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
