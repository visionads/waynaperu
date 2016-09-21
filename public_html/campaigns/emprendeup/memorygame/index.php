<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../../../vendor/autoload.php';
$session = new \CodeZero\Session\VanillaSession();
$csrf = new \Maer\Security\Csrf\Csrf();

?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Wayna UP</title>
	<meta name="description" content="Wayna UP">
	<meta name="author" content="Wayna">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/campaigns/emprendeup/memorygame/css/layout.css">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>

	<nav class="navbar navbar-default navbar-wayna">
		<div class="container">
			<div class="text-center">
				<a href="https://www.wayna.com.pe">
					<img src="https://www.wayna.com.pe/images/logo.png" alt="Wayna-logo">
				</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid">
		<div class="game">
			<div>
				<h4>
					<strong>Intentos:</strong>
					<span class="total-intentos">0</span>
				</h4>
			</div>
			<ul class="list-inline" id="imagelist"></ul>		
		</div>
	</div>

  	<div style="display:none;">
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
		<script src="/campaigns/emprendeup/memorygame/js/waynaup.js"></script>
	</div>

	<div class="modal fade" id="modal-intentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center">
						<h3 class="text-warning">¡Sigue intentandolo!</h3>
						<p>
							<span>Llevas <span class="total-intentos">0</span> de 3 intentos</span>
						</p>
					</div>
					<div class="text-center">
						<button type="button" id="seguir-intentandox" class="btn btn-primary" data-dismiss="modal">Seguir intentando</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-ganaste" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center">
						<p>
							<h3 class="text-warning">¡Has ganado¡</h3>
						</p>
						<p>
							Felicitaciones, has ganado 10% de descuento para que puedas canjearlo en cualquiera de nuestras experiencias.
						</p>
						<p>
							Para hacer válido este descuento, llena tus datos.
						</p>
					</div>
					<form name="mg-ganaste" method="post" action="ganaste.php">					
						<?php echo $csrf->getTokenField() ?>
						<div class="form-group form-input-validate">
							<label class="control-label">Nombre completo</label>
							<input type="text" name="names" autocomplete="off" placeholder="Ingresa tu nombre completo" class="form-control">
						</div>
						<div class="form-group form-input-validate">
							<label class="control-label">Tu Email</label>
							<input type="text" name="email" autocomplete="off" placeholder="Tu email" class="form-control">
						</div>
						<div class="form-group">
							<div class="checkbox form-input-validate">
								<label>
									<input type="checkbox" name="terms" checked="true" value="1">
									<span>Acepto los </span>
									<a href="/uploads/pdf/terminos-y-condiciones-sorteo-memorygame-emprendeup.pdf" target="_blank">Términos y condiciones</a>
								</label>
							</div>
						</div>
						<div class="text-center">
							<input type="hidden" name="source" value="waynaup-memorygame">
							<button type="button" class="btn btn-warning" id="recibir-descuento" data-loading-text="Registrando...">
								<i class="glyphicon glyphicon-ok"></i>
								<span>Quiero recibir mi descuento</span>
							</button>
							<button type="button" class="btn btn-danger" id="no-recibir-descuento">
								<i class="glyphicon glyphicon-remove"></i>
								<span>No deseo continuar, gracias</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-no-ganaste" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="text-center">
						<p>
							<h3 class="text-warning">¡Has jugado muy bien!</h3>
						</p>
						<p>
							<h5>Te invitamos a que lo intentes en otra oportunidad y que te registres para que te enteres de nuestras novedades.</h5>
						</p>
					</div>
					<form name="mg-no-ganaste" method="post" action="noganaste.php">
						<?php echo $csrf->getTokenField() ?>
						<div class="form-group form-input-validate">
							<label class="control-label">Tu Email</label>
							<input type="text" name="email" autocomplete="off" placeholder="Tu email" class="form-control">
						</div>
						<div class="form-group">
							<div class="checkbox form-input-validate">
								<label>
									<input type="checkbox" name="terms" checked="true" value="1">
									<span>Acepto los </span>
									<a href="/uploads/pdf/terminos-y-condiciones-sorteo-memorygame-emprendeup.pdf" target="_blank">Términos y condiciones</a>
								</label>
							</div>
						</div>
						<div class="text-center">
							<input type="hidden" name="source" value="waynaup-memorygame">
							<button type="button" class="btn btn-warning" id="recibir-novedades" data-loading-text="Registrando...">
								<i class="glyphicon glyphicon-ok"></i>
								<span>Quiero recibir novedades</span>
							</button>
							<button type="button" class="btn btn-danger" id="no-recibir-novedades">
								<i class="glyphicon glyphicon-remove"></i>
								<span>No deseo, gracias</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php if ( $session->get('flash') ) : ?>
		<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="text-center">
							<h3 class="text-warning">Wayna Games</h3>
							<?php $info = $session->get('info'); ?>
							<p><?php echo $info['message']; ?></p>
						</div>
						<div class="text-center">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $session->delete('info'); ?>
		<?php $session->delete('flash'); ?>
		<script type="text/javascript">
			$('div#modal-message').modal('show');
		</script>
	<?php endif; ?>
</body>
</html>
