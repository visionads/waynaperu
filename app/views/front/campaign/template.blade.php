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
.btnz {
    display: block;
    padding: 10px 15px;
    border:none;
    background-color: #ececec;
    text-decoration: none;
    font-size: 18px;
    color: #FFF;
    text-transform: none;
    margin: auto;
    width: 200px;
}
.btnz:hover {
    color: #efefef;
}
.facebook {
    background-color: #3b5998;
}
.twitter {
    background-color: #55acee;
}
@media screen and (max-width: 764px) {
	.nopl {
		padding-left: 15px;
	}
}
@media screen and (max-width: 480px) {
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
	.thanks br {
		display: none;
	}
	.btnz {
		width: 75%;
		padding: 5px;
		font-size: 14px;
	}
}

</style>
<div id="modal-campaign" class="modal fade in" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<form name="campaign-mother-of-day" action="{{ url('campaigns/mothers-of-day/store') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-5 hidden-xs">
							<div>
								<img src="{{ url('images/popup_day.jpg') }}" alt="día de la madre" class="img-responsive">
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 nopl">
							<div class="form-group text-center text-orange visible-xs">
								<h3>¡Participa por un regalo a mamá!</h3>
							</div>
							<div class="form-group form-input-validate">
								<label class="control-label">Nombres:</label>
								<input type="text" name="names" class="form-control" autocomplete="off" maxlength="45" placeholder="Ingresa tu nombre">
							</div>
							<div class="form-group form-input-validate">
								<label class="control-label">Apellido Paterno:</label>
								<input type="text" name="surname_father" class="form-control"  autocomplete="off"  maxlength="65" placeholder="Ingresa tu apellido paterno">
							</div>
							<div class="form-group form-input-validate">
								<label class="control-label">Apellido Materno:</label>
								<input type="text" name="surname_mother" class="form-control"  autocomplete="off"  maxlength="65" placeholder="Ingresa tu apellido materno">
							</div>
							<div class="form-group form-input-validate">
								<label class="control-label">DNI:</label>
								<input type="text" name="dni" class="form-control" autocomplete="off"  maxlength="8" placeholder="Ingresa tu DNI">
							</div>
							<div class="form-group form-input-validate">
								<label class="control-label">Email:</label>
								<input type="text" name="email" class="form-control" autocomplete="off"  maxlength="65" placeholder="Ingresa tu email">
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
									<input type="hidden" name="source" value="web">
								</div>
							</div>
							<div class="text-center">
								<a href="/uploads/pdf/terminos-y-condiciones-sorteo-dia-de-la-madre.pdf" data-dismiss="modal">No deseo participar</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-campaign-thanks" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close button-close-fix" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="thanks">
					<div class="text-center">
						<p class="intro">
							<span>los resultados saldrán el 5 de mayo a las 6:00 pm</span>
						</p>
						<p class="subintro">
							<span>GRACIAS POR PARTICIPAR EN EL CONCURSO DEL DÍA DE LA MADRE</span>
						</p>
						<h3>¡MUCHA SUERTE!</h3>
						<br>
						<!--
						<a class="exp_facebookvp" href="https://www.facebook.com/sharer/sharer.php?u=http://wayna.apps.sense404.com/" target="_blank"><img src="http://wayna.apps.sense404.com/images/facebook.png" alt=""></a>
						<br>-->
						<a class="btnz share facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://wayna.com.pe"><i class="fa fa-facebook"></i> Compartelo!</a>
					</div>
				</div>
				<img src="/images/popup_day_thanks.jpg" alt="day_thanks" class="img-responsive">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
