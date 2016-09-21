@extends('front.layout')

@extends('front.header')

@extends('front.footer')

@section('content')
        <!-- Page Content -->
<div class="checkout_wrapper-main">
    <div class="container">
        <div class="checkout_wrapper">
            {{  Form::open(array('route' => 'process_checkout', 'data-toggle'=>'validator', 'id' => 'ajaxform')) }}
            <div class="cart_top_row row bdr_none">
                <div class="col-md-3 col-sm-2 mobile-hide">&nbsp; </div>
                <div class="col-md-6 col-sm-8">
                    <ul class="cart_page_listing">
                        <li class="complete">{{ trans('text.my_cart') }}</li>
                        <li class="complete">{{ trans('text.personalization') }}</li>
                        <li class="active_cart">{{ trans('text.Shipping_n_payment') }}</li>
                        <li>{{ trans('text.thank_you') }}</li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-2 mobile-hide text-right">&nbsp; </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">

                    <div class="mod-of-pay">
                        <h3>{{ trans('text.payment_method') }}</h3>


                        <div class="pay_row">
                            <!--
                            <div class="mad_pay_row" style="opacity: .5;pointer-events: none;">
                                <input type="radio" name="payment_gateway" value="pago" required/>
                                <div class="m_payment_content">
                                    <img src="{{ asset('images/payment1.png') }}" alt="" />
                                    <a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<p>{{ trans('text.payment_method_text') }}</p>"><img src="{{ asset('images/orange_questionmark.png') }}" alt="" /></a>

                                </div>
                            </div>
                            -->
                            <div class="mad_pay_row culqi">
                                <input type="radio" name="payment_gateway" value="culqi" required/>
                                <div class="m_payment_content">
                                    <img src="{{ asset('images/pay_visa.png') }}" alt="" />&nbsp;<img src="{{ asset('images/pay_mastercard.png') }}" alt="" />&nbsp;<img src="{{ asset('images/pay_dinersclub.png') }}" alt="" />&nbsp;<img src="{{ asset('images/pay_amex.png') }}" alt="" />
                                    <div class="pull-right">
                                    <a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<p><img src='{{ asset('images/culqi_tooltip.png') }}' alt='' style='width:280px;height:300px;'/></p>"><img src="{{ asset('images/orange_questionmark.png') }}" alt="" /></a>
                                    </div>
                                </div>
                            </div>

                            <div class="mad_pay_row">
                                <input type="radio" name="payment_gateway" value="agente_bcp" required/>
                                <div class="m_payment_content">
                                    <img src="{{ asset('images/pay_bcpagente.png') }}" alt="" width="50" />
                                    <a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<p>{{ trans('text.agent_bcp') }}</p>"><img src="{{ asset('images/orange_questionmark.png') }}" alt="" /></a>

                                </div>
                            </div>

                            <!-- <div class="mad_pay_row">
                                    <input type="radio" name="mode-of-payment" />
                                    <div class="m_payment_content">
                                        <img src="{{ asset('images/payment4.png') }}" alt="" />
                                        <p>Pago con tu tarjeta de Diners Club</p>
                                    </div>
                                 </div> -->

                            <div class="mad_pay_row  form-group">
                                <input type="checkbox" name="accept_terms" value="1" required/>

                                <div class="m_payment_content">
                                    <p>{{ trans('text.i_accept') }} <a href="{{ route('terms_n_conditions') }}">{{ trans('text.terms_n_conditions') }}</a>.<!-- , <a href="#">{{ trans('text.privacy_policy')}}</a>, {{ trans('text.and') }} <a href="#">{{ trans('text.shipping_conditions') }}</a> --></p>
                                </div>
                            </div>

                            {{--  <div class="mad_pay_row">
                              <label>{{ trans('text.account_address') }}</label>
                                <input type="text" name="mode-of-payment" />
                             </div> --}}

                            <input type="submit" value="{{ trans('text.buy') }}" class="btn btn-success" id="smt"/>
                                <span id="lodding" style="display: none">Lodding......</span>
                            <div id="paymentBtn" style="display: none;">
                                <a href="javascript:void(0);" id="btn-pay" class="btn btn-success btn-lg" >{{ trans('text.confirm') }}</a>
                                <br>
                                <span style="font-size: 10px;color: red;">{{ trans('text.confirm_payment') }}</span>
                            </div>

                        </div>


                    </div>

                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="resume_campare">
                        <h2>{{ trans('text.purchase_summary') }}</h2>

                        <div class="compare_wrapper">
                            <div class="pay-product_listing custom-repares mCustomScrollbar">
                                <?php $total_price = 0;
                                $total_qty = 0;
                                ?>
                                @foreach($cart_con as $cart)
                                    <h3>{{ getExpName($cart->id) }}<br> #18739283</h3>
                                    <?php $total_price = $total_price + $cart->price;
                                    $total_qty = $total_qty + $cart->qty;
                                    ?>
                                    <div class="row row_content">
                                        <div class="col-md-4 col-sm-4 col-xs-4"><img class="img-responsive" src="{{ asset('uploads/products/thumbs/thumb_'.getLocImage($cart->options['loc_id'])) }}" alt="" /></div>
                                        <div class="col-md-8 col-sm-8 col-xs-8">
                                            @if($cart->options['pdf'] > 0 )
                                                <div class="pay_pro_row row">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <span style="font-size:13px" class="hidden-xs">{{ trans('text.experience_pin_adult') }}:</span>
                                                        <span style="font-size:13px" class="hidden-lg pull-left">{{ trans('text.experience_pin_adult') }}:</span>
                                                    </div>                                                
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $cart->options['pdf'] }} x {{ getLocName($cart->options['loc_id']) }}</p></div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. {{ getPdfPrice($cart->options['loc_id'], $cart->options['pdf']) }}</span></div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                                               <div class="row">
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><p>1 x 10 min extra & Video</p></div>
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. 19.90</span></div>
                                                               </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($cart->options['mail'] > 0 )
                                                <div class="pay_pro_row row">
                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                        <span style="font-size:13px" class="hidden-xs">{{ trans('text.experience_pin_boy') }}:</span>
                                                        <span style="font-size:13px" class="hidden-lg pull-left">{{ trans('text.experience_pin_boy') }}:</span>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $cart->options['mail'] }} x {{ getLocName($cart->options['loc_id']) }}</p></div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. {{ getMailPrice($cart->options['loc_id'], $cart->options['mail']) }}</span></div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                                               <div class="row">
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><p>1 x 10 min extra & Video</p></div>
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. 19.90</span></div>
                                                               </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($cart->options['gift'] > 0 )
                                                <div class="pay_pro_row row">
                                                    <div class="col-md-1 col-sm-1 col-xs-1"><span class="fa fa-gift"></span></div>
                                                    <div class="col-md-11 col-sm-11 col-xs-11">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $cart->options['gift'] }} x {{ getLocName($cart->options['loc_id']) }}</p></div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. {{ getGiftPrice($cart->options['loc_id'], $cart->options['gift']) }}</span></div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                                               <div class="row">
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><p>1 x 10 min extra & Video</p></div>
                                                                  <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. 19.90</span></div>
                                                               </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                @endforeach


                            </div>
                            <div class="paytotal_price">{{ trans('text.total_price') }}:   <span>S/. {{ number_format($total_price, 2) }}</span></div>
                            <?php
                            /*
                            $pri = explode('.', $total_price);
                            $pay_price = $pri[0];
                            if(isset($pri[1]))
                            {
                              $pay_price = $pay_price.$pri[1];
                            }else{
                              $pay_price = $pay_price.'00';
                            }
                            */
                            ?>
                            <input type="hidden" name="qty" value="{{ $total_qty }}">
                            <input type="hidden" name="price" value="{{ ($total_price) }}">
                        </div>

                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->

@if(Auth::check())
@if ( Auth::user()->first_name == '' || Auth::user()->last_name == '' || Auth::user()->direction == '' || Auth::user()->district == '' || Auth::user()->city == '' || Auth::user()->phone == '')


        <!-- MODAL -->
<div class="modal fade" id="modal-register-checkout" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body login_main_wrapper">
                <div class="row">
                    <div class="col-md-12 col-sm-12 register">
                        {{  Form::open(array('route' => 'update_account', 'class' => 'registration-form fomrm_left', 'data-toggle'=>'validator')) }}
                        <p>{{ trans('text.update_shipping_info') }}
                        </p>
                        <div class="user_title"><strong>{{ trans('text.user') }}</strong></div>
                        <div class="form_row">
                            <input class="cart_form2int inputbtn1" type="text" id="f-name" name="f-name" placeholder="{{ trans('text.first_name') }}" value="{{ Auth::user()->first_name }}" required/>
                            @if ($errors->has('f-name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('f-name') }}</div>
                            @endif
                        </div>
                        <div class="form_row">
                            <input class="cart_form2int inputbtn1" type="text" id="l-name" name="l-name" placeholder="{{ trans('text.surname') }}" value="{{ Auth::user()->last_name }}" required/>
                            @if ($errors->has('l-name'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('l-name') }}</div>
                            @endif
                        </div>


                        <div class="form_row">
                            <input class="cart_form2int inputbtn1" type="text" id="direction" name="direction" value="{{ Auth::user()->direction }}" placeholder="{{ trans('text.address') }}" required/>
                            @if ($errors->has('direction'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('direction') }}</div>
                            @endif
                        </div>

                        <div class="form_row">
                            <input class="cart_form2int inputbtn2" type="text" id="district" name="district" value="{{ Auth::user()->  district }}" placeholder="{{ trans('text.districtt') }}" required/>
                            @if ($errors->has('district'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('district') }}</div>
                            @endif
                        </div>
                        <div class="form_row">
                            <input class="cart_form2int inputbtn2" type="text" id="city" name="city" placeholder="{{ trans('text.city') }}" value="{{ Auth::user()->city }}" required/>
                            @if ($errors->has('city'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('city') }}</div>
                            @endif

                        </div>

                        <div class="form_row">
                            <input class="cart_form2int inputbtn2" type="text" id="phone" name="phone" placeholder="{{ trans('text.phone') }}" value="{{ Auth::user()->phone }}" required/>
                            <p>{{ trans('text.phone_msg') }}</p>
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger" role="alert">{{ $errors->first('phone') }}</div>
                            @endif

                        </div>
                        {{-- <div class="form-group">
                          {{ Form::captcha(array('lang' => LaravelLocalization::getCurrentLocale())) }}
                        </div> --}}
                        <div class="text-center"><button type="submit" class="btn btn-success">{{ trans('text.update') }}</button></div>

                        {{ Form::close() }}
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endif
@endif
        <!-- MODAL -->
<div class="modal fade" id="modal-culqi-error" tabindex="-1" role="dialog" aria-labelledby="modal-culqi-error-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger" role="alert"></div>

            </div>

        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="modal-culqi-button" tabindex="-1" role="dialog" aria-labelledby="modal-culqi-button-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">
                    <img src="{{ asset('images/culqi_tooltip.png') }}" alt='' class="img-responsive">
                </p>
                <p class="text-center">
                    {{--<a href="javascript:void(0);" id="btn-pay" class="btn btn-success">{{ trans('text.buy') }}</a>--}}
                </p>
            </div>

        </div>
    </div>
</div>

@stop

@section('footer_script')
    <script src="https://pago.culqi.com/api/v1/culqi.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.mad_pay_row input[type=radio]').change(function() {
                if (this.value == 'culqi') {
                    console.log("culqi");
                    $('.pay_row input[type=submit]').val("{{ trans('text.continue_to_pay') }}");
                }
                else {
                    console.log("other");
                    $('.pay_row input[type=submit]').val("{{ trans('text.buy') }}");
                }
            });
            $('#btn-pay').click(function(e){$('#modal-culqi-button').modal('hide');checkout.abrir();e.preventDefault();});
            //callback handler for form submit
            $("#ajaxform").submit(function(e)
            {
                $('#smt').hide();
                $('#lodding').show();
                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
                $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : postData,
                            success:function(data, textStatus, jqXHR)
                            {
                                if(data.method == 'culqi' && data.state == 'success'){
                                    checkout.codigo_comercio = "9preKzsz6VbY";
                                    checkout.informacion_venta = data.informacionVenta;

                                    $.cookie('order_number', data.order_number);
                                    $('#lodding').hide();
                                    $('#paymentBtn').show();
//                                    $( '#modal-culqi-button').modal();
                                }
                                if(data.method == 'agente_bcp' && data.state == 'success'){
                                    /*var home_url = '{{ route("home") }}';
                                     var success_url = home_url+'/order/success/'+data.order_number;
                                     console.log(success_url);
                                     location.href=success_url;*/
                                    var home_url = '{{ route("home") }}';
                                    var success_url = home_url+'/agente-bcp/'+data.order_number;
                                    console.log(success_url);
                                    location.href=success_url;
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown)
                            {
                                //if fails
                            }
                        });
                e.preventDefault(); //STOP default action
                // e.unbind(); //unbind. to stop multiple form submit.
            });

            //$("#ajaxform").submit(); //Submit  the FORM
        });
        function culqi (checkout) {
            $.ajax({
                url: '{{ route("culqi_ipn") }}',
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(
                        {
                            'respuesta' : checkout.respuesta
                        }),
                success: function(data){
                    console.log(data);
                    if(data == 'checkout_cerrado'){
                        $('#modal-culqi-error .modal-body .alert').html('You have closed the payment form, Please try again..');
                        $( '#modal-culqi-error').modal();
                    }else if(data == 'venta_expirada'){
                        $('#modal-culqi-error .modal-body .alert').html('Your payment form is expired, Please try again..');
                        $( '#modal-culqi-error').modal();
                    }else{
                        var obj = JSON.parse(data);
                        var respuesta_venta = obj["codigo_respuesta"];
                        if (respuesta_venta == "venta_exitosa") {
                            var order_number = $.cookie("order_number");
                            var home_url = '{{ route("home") }}';
                            var success_url = home_url+'/order/success/'+order_number;
                            console.log(success_url);
                            location.href=success_url;
                            console.log('succes');
                        } else {
                            $('#modal-culqi-error .modal-body .alert').html(obj["mensaje_respuesta_usuario"]);
                            $( '#modal-culqi-error').modal();
                            console.log('else');
                        }
                    }
                },
                error:function( ){
                    console.log('error');
                }
            });
            // console.log(checkout.respuesta);
            checkout.cerrar();
        };
    </script>
@stop
