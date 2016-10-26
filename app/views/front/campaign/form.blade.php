<!DOCTYPE html>
<html lang="en">
   	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Exploor</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

      	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      	<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      	<![endif]-->
		<style type="text/css">
			.form-input-error {
				color: #FF7878;
			}
			.form-input-error input[type="text"],
			.form-input-error input[type="password"]
			{
				color: #FF7878;
				background: url('images/error.png') 98% center no-repeat;
				border: 1px solid #FF7878;
			}
			.form-input-valid {
				color: #67A967;	
			}
			.form-input-valid input[type="text"],
			.form-input-valid input[type="password"]
			{
				color: #67A967;
				border: 1px solid #67A967;
			}
			.nopl {
				padding-left: 0;
			}
			.thanks {
				position: absolute;
			    margin: 10px;
			    margin-right: 250px;
			    margin-top: 40px;
			    text-align: center;
			    color: #f97d03;
			    text-transform: uppercase;
			}
			.thanks span,
			.thanks h3
			{
				font-weight: bold;
			}
			.thanks .intro {
				font-size: 20px;
			}
			.thanks .subintro {
				font-size: 16px;
			}
			.thanks h3 {
				font-size: 30px;
			}
			.button-close-fix {
			    float: right;
			    position: absolute;
			    right: 20px;
			    font-size: 40px;
			    color: red;
			}
			.text-orange {
				color: orange;
			}
			@media screen and (max-width: 764px) {
				.nopl {
					padding-left: 15px;
				}

				.thanks {
				    margin-top: 10px;
				    margin-right: 130px;
				    margin-left: 0;
				}
				.thanks .intro,
				.thanks h3
				{
					font-size: 14px;
				}
				.thanks .subintro
				{
					font-size: 13px;
				}
			}

		</style>

      	<script type="text/javascript">
      		$(document).ready(function(){
			    // popup

			    $('form[name="campaign-mother-of-day"]').validate({
			        highlight: function(element, errorClass, validClass) {
			            $(element).parents('div.form-input-validate').removeClass('form-input-valid').addClass('form-input-error');
			        },
			        unhighlight: function(element, errorClass, validClass) {
			            $(element).parents('div.form-input-validate').removeClass('form-input-error').addClass('form-input-valid');
			        },
			        rules: {
			            names: { required: true, minlength: 2 },
			            surname_father: { required: true, minlength: 2 },
			            surname_mother: { required: true, minlength: 2 },
			            dni: { required: true, digits: true, minlength: 8, maxlength: 8 },
			            email: { required: true, email: true },
			            terms: { required: true },
			        },
			        messages: {
			            names: {
			                required: 'Este campo es requerido',
			                minlength: 'Ingrese como mínimo 2 caracteres'
			            },
			            surname_father: {
			                required: 'Este campo es requerido',
			                minlength: 'Ingrese como mínimo 2 caracteres'
			            },
			            surname_mother: {
			                required: 'Este campo es requerido',
			                minlength: 'Ingrese como mínimo 2 caracteres'
			            },
			            dni: {
			                required: 'Este campo es requerido',
			                numeric: 'Ingrese un número de DNI válido',
			                minlength: 'Ingrese un número de 8 digitos',
			                maxlength: 'Ingrese un número de 8 digitos'
			            },
			            email: {
			                required: 'Este campo es requerido',
			                email: 'Ingrese un email válido'
			            },
			            terms: {
			                required: 'Este campo es requerido'
			            }
			        }
			    });

			    $('button#lestgo').click(function (e) {
			        e.preventDefault();

			        var $form = $('form[name="campaign-mother-of-day"]');
			        var $btn = $('button#lestgo');
			        if( $form.valid() ) {
			        	$form.submit();
			        }
			    });
      		});
      	</script>
   	</head>
   	<body>
   		<div class="container">
   			<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<form name="campaign-mother-of-day" action="{{ url('campaigns/mothers-of-day/single') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs">
							<div>
								<img src="{{ url('images/popup_day.jpg') }}" alt="día de la madre" class="img-responsive">
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 nopl">
							<div class="form-group text-center text-orange visible-xs">
								<h3>!Participa por un regalo a mamá!</h3>
							</div>
							<div class="form-group form-input-validate{{ $errors->has('names') ? ' form-input-error' : '' }}">
								<label class="control-label">Nombres:</label>
								<input type="text" name="names" class="form-control" autocomplete="off" maxlength="45" placeholder="Ingresa tu nombre">
								<div class="error-message-item">
									{{ $errors->first('names') }}
								</div>
							</div>
							<div class="form-group form-input-validate{{ $errors->has('surname_father') ? ' form-input-error' : '' }}">
								<label class="control-label">Apellido Paterno:</label>
								<input type="text" name="surname_father" class="form-control"  autocomplete="off"  maxlength="65" placeholder="Ingresa tu apellido paterno">
								<div class="error-message-item">
									{{ $errors->first('surname_father') }}
								</div>
							</div>
							<div class="form-group form-input-validate{{ $errors->has('surname_mother') ? ' form-input-error' : '' }}">
								<label class="control-label">Apellido Materno:</label>
								<input type="text" name="surname_mother" class="form-control"  autocomplete="off"  maxlength="65" placeholder="Ingresa tu apellido materno">
								<div class="error-message-item">
									{{ $errors->first('surname_mother') }}
								</div>
							</div>
							<div class="form-group form-input-validate{{ $errors->has('dni') ? ' form-input-error' : '' }}">
								<label class="control-label">DNI:</label>
								<input type="text" name="dni" class="form-control" autocomplete="off"  maxlength="8" placeholder="Ingresa tu DNI">
								<div class="error-message-item">
									{{ $errors->first('dni') }}
								</div>
							</div>
							<div class="form-group form-input-validate{{ $errors->has('names') ? ' form-input-error' : '' }}">
								<label class="control-label">Email:</label>
								<input type="text" name="email" class="form-control" autocomplete="off"  maxlength="65" placeholder="Ingresa tu email">
								<div class="error-message-item">
									{{ $errors->first('email') }}
								</div>
							</div>
							<div class="form-group">
								<div class="checkbox form-input-validate">
									<label>
										<input type="checkbox" name="term" checked="true" value="1">
										<span>Acepto los </span>
										<a href="/uploads/pdf/terminos-y-condiciones-sorteo-dia-de-la-madre.pdf" target="_blank">términos y condiciones</a>
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="text-center">
									<button type="button" class="btn btn-warning btn-block" id="lestgo" data-loading-text="Loading...">
										<span>Quiero participar!</span>
									</button>
									<button class="btn btn-primary btn-block">
										<i class="fa fa-facebook-official" aria-hidden="true"></i>
										<span>Participar con facebook</span>
									</button>
									<input type="hidden" name="source" value="web">
								</div>
							</div>
						</div>
					</div>
				</form>   			
   			</div>
		</div>
	</body>
</html>
