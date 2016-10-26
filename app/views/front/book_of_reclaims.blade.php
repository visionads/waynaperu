@extends('front.layout')
@extends('front.header')
@extends('front.sidebar')
@extends('front.footer')
@section('content')
	<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding: 20px 0;">
                <div style="width: 50%; padding: 2% 5%; margin: auto; background: #fff; border-radius: 10px; font-size: 12px !Important; box-shadow: 0 0 5px #e0e0e0;">
                    <div class="page_title text-center">
                        <span style="font-size: 20px;">Libro de Reclamos</span>
                    </div>
                    <div class="page_title">
                        <span style="font-size: 16px; font-weight: bold; color: orange">Identificación del consumidor reclamante</span>
                    </div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Nombre : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Apellido : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Domicilio : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Tipo de documento : </label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option>RUC</option>
                                    <option>DNI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Número de documento : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Teléfono : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email : </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label><input type="checkbox"> ¿Eres menor de edad?</label>
                                </div>
                            </div>
                        </div>


                        <div class="page_title">
                            <span style="font-size: 16px; font-weight: bold; color: orange">Identificación del bien</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="radio-inline"><input type="radio" name="optradio">Producto</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Servicio</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Decripción : </label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="email" placeholder="Enter email"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Códido de Groupon <br>(Opcional) </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" placeholder="Enter email">
                                <span>Sólo si el reclamo es por productos y servicios.</span>
                            </div>
                        </div>


                        <div class="page_title">
                            <span style="font-size: 16px; font-weight: bold; color: orange">Detalle de consulta</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <label class="radio-inline"><input type="radio" name="optradio">Reclamo</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Queja</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Detalle : </label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" id="email" placeholder="Enter email"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                CAPCHA will be placed here
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <strong>Debes saber que:</strong><br>
                                Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, Groupon cuenta con un Libro de Reclamaciones a tu disposición. Al llenar todos estos datos nos entregas información que permite darte una solución de manera más rápida y eficiente.
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
     <!-- /#page-content-wrapper -->
@stop