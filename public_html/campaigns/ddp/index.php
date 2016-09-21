<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../../vendor/autoload.php';
$session = new \CodeZero\Session\VanillaSession();
$csrf = new \Maer\Security\Csrf\Csrf();

?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Wayna - Día del Padre</title>
	<meta name="description" content="Wayna UP">
	<meta name="author" content="Wayna">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/campaigns/ddp/css/animate.css">
	<link rel="stylesheet" href="/campaigns/ddp/css/layout.css">

	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
	<div id="bg"></div>
	<div id="overlay"></div>
	<div id="content">
		<!--<img src="/campaigns/ddp/img/logowayna.png" alt="logo" width="76" id="logowayna">-->
		<p class="text-white animated slideInUp">Podrás enseñarle algo nuevo a tu papá <br>y divertirse en el campo de paintball entre bolas de pintura!</p>
	</div>
	<div id="formulario" class="animated slideInDown">
		<form name="waynaup" method="post" action="wayna.php">
		    <?php echo $csrf->getTokenField() ?>
			<div class="col-lg-12">
				<br>
				<div class="form-group">
					<div class="text-center">
						<img src="/images/logo.png" alt="logo">
					</div>
				</div>
				<?php if ( $session->get('flash') ) : ?>
					<?php $info = $session->get('info'); ?>
					<?php if ( $info['type'] === 'success' ) : ?>
						<div class="alert alert-success">
						<?php echo $info['message']; ?>
						</div>
					<?php endif; ?>	
					<?php if ( $info['type'] === 'error' ) : ?>
						<div class="alert alert-danger">
						<?php echo $info['message']; ?>
						</div>
					<?php endif; ?>
					<?php if ( $info['type'] === 'info' ) : ?>
						<div class="alert alert-info">
						<?php echo $info['message']; ?>
						</div>
					<?php endif; ?>					
				<?php endif; ?>
				<?php $session->delete('info'); ?>
				<?php $session->delete('flash'); ?>
				<div class="form-group form-input-validate">
					<label class="control-label">Nombres:</label>
					<input type="text" name="names" placeholder="Tus Nombres" autocomplete="off" class="form-control">
				</div>
				<div class="form-group form-input-validate">
					<label class="control-label">Apellidos:</label>
					<input type="text" name="surname_father" placeholder="Tus Apellidos" autocomplete="off" class="form-control">
				</div>
				<div class="form-group form-input-validate">
					<label class="control-label">Email:</label>
					<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control">
				</div>
				<div class="form-group">
					<div class="checkbox form-input-validate">
						<label>
							<input type="checkbox" name="terms" checked="true" value="1">
							<span>Acepto los </span>
							<a href="/uploads/pdf/terminos-y-condiciones-sorteo-ddp.pdf" target="_blank">Términos y condiciones</a>
						</label>
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-warning btn-block" id="lestgo" data-loading-text="Registrando...">
						<i class="glyphicon glyphicon-ok"></i>
						<span>Registrarme y Participar!</span>
					</button>
					<input type="hidden" name="source" value="waynaup-ddp">
				</div>
			</div>
		</form>
	</div>
  	<div style="display:none;">
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
		<script src="/campaigns/ddp/js/wayna.js"></script>
	</div>
</body>
</html>
