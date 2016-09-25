@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')         
<!-- Page Content -->         
<div id="page-content-wrapper">
    <div class="container-fluid">
        {{--<br>--}}
        <!--como end here-->
        <div class="como">
            <div class="row">
                <div class="heading col-md-12">
                    <h2>{{ $how_wayna_work->title }}</h2>
                </div>
                {{ $how_wayna_work->description }}                  
            </div>
        </div>        
        <div class="row">
            @include('front.form-filter')
        </div>
        <!-- catory grid--> 
        <div class="row clearfix">
            @include('front._productList')
        </div>
        <!--bloque end here-->

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-newsletter">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-body clearfix" style="padding: 0;">
                <form name="newsletter" action="{{ url('newsletter') }}" method="post" class="form">
                    <ul class="clearfix">
                        <li>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="text-center">
                                        <h4 style="margin-top: 15px;">
                                            <strong>Subscríbete y se parte de nuevas experiencias.</strong>
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group form-input-validate">
                                    <label>Tu nombre:</label>
                                    <input type="text" name="names" placeholder="Nombre" class="form-control input-sm" autocomplete="off">
                                </div>
                                <div class="form-group form-input-validate">
                                    <label>Tu email:</label>
                                    <input type="text" name="email" placeholder="Email" class="form-control input-sm" autocomplete="off">
                                </div>
                                <div class="form-group form-input-validate">
                                    <label>Sexo:</label>
                                    <span>
                                        <input type="radio" name="sexo" value="1" checked="checked">
                                        <span>Masculino</span>
                                    </span>
                                    <span>
                                        <input type="radio" name="sexo" value="0">
                                        <span>Femenino</span>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="checkbox form-input-validate">
                                            <label class="small-text">
                                                <input type="checkbox" name="terms" checked="true" value="1">
                                                <span>Acepto los </span><a href="{{ url('/uploads/pdf/terminos-y-condicionesn-ewsletter.pdf') }}" target="_blank">Términos y condiciones</a>
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-warning" id="gonewsletter">Quiero recibir actividades</button>
                                        <a class="btn" data-dismiss="modal">Ya me registre, quiero ver las actividades</a>
                                        <input type="hidden" name="source" value="newsletter">
                                    </div>
                                </div>
                            </div>
                        </li><li class="hidden-xs">
                            <img src="{{ url('/images/bg_newsletter.jpg') }}" style="max-width: 100%;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;position: absolute;right: 15px;top: 5px;color: red;z-index:100;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal-newsletter-success" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="dialog">
        <div class="modal-content" style="border-radius: 0;padding: 30px;">
            <div class="modal-body clearfix" style="padding: 0;">
                <div class="text-center">
                    <h3><strong>¡Felicidades!</strong></h3>
                    <p>
                        <span>Estás subscrito para el Newsletter</span>
                    </p>
                    <a class="btn btn-warning" data-dismiss="modal">Ver actividades</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
