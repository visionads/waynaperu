@extends('front.layout')

@extends('front.header')

@extends('front.footer')

@section('content')
    <!-- Page Content -->
         <div class="checkout_wrapper-main">
            <div class="container-fluid">
               
               
        <div class="checkout_wrapper">
          {{  Form::open(array('route' => 'process_checkout', 'data-toggle'=>'validator')) }}
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
                       <div class="col-md-5 col-sm-12">
                           <div class="checkout-left content-scroll mCustomScrollbar">
                            <h2>{{ trans('text.delivery_data') }}</h2>
                              @foreach($cart_con as $cart)
                              <h3>{{ $cart->name }}</h3>
                             
                              @if($cart->options['pdf'] > 0 )
                              <?php $count = $cart->options['pdf']; ?>
                              <!-- Via PDF -->
                                <div class="exp1">
                                   <div class="via_mail">
                                     <span class="fa fa-at"></span>
                                     <h4>{{ trans('text.via_mail') }}</h4>
                                   </div>
                                   <div class="chk_select">
                                      <label>{{ trans('text.qty') }}</label>
                                        <select id="basic" name="qty_pdf[{{ $cart->id}}]" class="selectpicker form-control" required>
                                          @for($i=1; $i<= $count; $i++)
                                            <option @if($i == $count) selected @endif>{{ $i }}</option>
                                          @endfor
                                      </select>
                                   </div>
                                   <div class="chk_button_sec">
                                      <a href="javascript:void(0)" class="btn-edit btn-pdf">{{trans('text.edit') }}</a>
                                      @if($count>1)
                                        <a href="javascript:void(0)" data-pid="{{ $cart->id}}" class="btn-send btn-pdf" data-total="{{ $count }}" data-count="1">Anadir otro</a>
                                      @endif
                                   </div>
                                   @if(Auth::check())
                                      <?php $u_email = Auth::user()->email;?>
                                   @else
                                      <?php $u_email =  Session::get('guest.email')[0];?>
                                   @endif
                                   <p>{{ trans('text.mail_to') }}: <input name="email_pdf[{{ $cart->id}}][]" class="diasbled-field" type="text" value="{{ $u_email }}" required/></p> 
                                   <div class="checkout_form">
                                      <div class="field_row">
                                         <input class="datepicker" name="date_pdf[{{ $cart->id}}][]" type="text" class="field1" placeholder="{{ trans('text.date') }}" required/>
                                          
                                      </div>
                                      <div class="field_row">
                                         <input type="text" name="from_pdf[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.para') }}" />
                                         <input type="text" name="to_pdf[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.por') }}" />
                                      </div>
                                      <div class="field_row">
                                         <textarea name="msg_pdf[{{ $cart->id}}][]" placeholder="{{ trans('text.per_msg') }}" ></textarea>
                                      </div>
                                      
                                   </div>
                                   <div class="append"></div>
                                </div>
                                @endif
                                @if($cart->options['mail'] > 0 )
                                <?php $count = $cart->options['mail']; ?>
                                <!-- Via Mail -->
                                <div class="exp1">
                                   <div class="via_mail">
                                     <span class="fa fa-envelope"></span>
                                     <h4>{{trans('text.via_correspondence') }}</h4>
                                   </div>
                                   <div class="chk_select">
                                     <label>{{ trans('text.qty') }}</label>
                                     <select id="basic" name="qty_mail[{{ $cart->id}}]" class="selectpicker form-control" required>
                                        @for($i=1; $i<= $count; $i++)
                                          <option @if($i == $count) selected @endif>{{ $i }}</option>
                                        @endfor
                                      </select>
                                   </div>
                                   <div class="chk_button_sec">
                                      <a href="javascript:void(0)" class="btn-edit btn-mail">{{ trans('text.edit') }}</a>
                                      @if($count>1)
                                        <a href="javascript:void(0)" data-pid="{{ $cart->id}}" class="btn-send btn-mail">{{ trans('text.add_another') }}</a>
                                      @endif
                                   </div>
                  
                                   <div class="form_listing">
                                    @if(Auth::check())
                                      <?php $u_address = Auth::user()->first_name." ".Auth::user()->last_name."\r\n".Auth::user()->direction."\r\n".Auth::user()->flat." ".Auth::user()->dep."\r\n".Auth::user()->district;?>
                                    @else
                                      <?php $u_address =  Session::get('guest.f_name')[0]." ".Session::get('guest.l_name')[0]."\r\n".Session::get('guest.direction')[0]."\r\n".Session::get('guest.flat')[0]." ".Session::get('guest.dep')[0]."\r\n".Session::get('guest.district')[0];?>
                                    @endif
                                      <textarea rows="5" cols="30" name="mailAddress_mail[{{ $cart->id }}][]" class="disabled-field" required>{{ $u_address }}
                                      </textarea>
                                      <div class="del_wrapper">
                                         <label>{{ trans('text.delivery_type') }}:</label>
                                         <div class="del_row1">
                                            <input type="radio" value="express" name="mailshipping_mail[{{ $cart->id}}][]" checked required/>
                                            <p><em>Express</em> <span>(X S/. )</span></p>
                                         </div>
                                         <div class="del_row1">
                                            <input type="radio" value="priority" name="mailshipping_mail[{{ $cart->id}}][]" required/>
                                            <p><em>{{ trans('text.priority') }}</em>  <span>(X S/. )</span></p>
                                         </div>
                                         
                                      </div>
                                      
                                   </div>
                                   
                                   <div class="checkout_form">
                                      <div class="field_row">
                                         <input class="datepicker" name="date_mail[{{ $cart->id}}][]" type="text" class="field1" placeholder="{{ trans('text.date') }}" required/>
                                          
                                      </div>
                                      <div class="field_row">
                                         <input type="text" name="from_mail[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.para') }}" />
                                         <input type="text" name="to_mail[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.por') }}" />
                                      </div>
                                      <div class="field_row">
                                         <textarea name="msg_mail[{{ $cart->id}}][]" placeholder="{{ trans('text.per_msg') }}" ></textarea>
                                      </div>
                                      
                                   </div>
                                   <div class="append"></div>
                                </div>
                                @endif
                                @if($cart->options['gift'] > 0 )
                                <?php $count = $cart->options['gift']; ?>
                                <!-- Via Gift -->
                                <div class="exp1">
                                   <div class="via_mail">
                                     <span class="fa fa-gift"></span>
                                     <h4>{{ trans('text.via_surprise_gift') }}</h4>
                                   </div>
                                   <div class="chk_select">
                                      <label>{{ trans('text.via_surprise_gift') }}</label>
                                      <select id="basic" name="qty_gift[{{ $cart->id}}]" class="selectpicker form-control" required>
                                        @for($i=1; $i<= $count; $i++)
                                          <option @if($i == $count) selected @endif>{{ $i }}</option>
                                        @endfor
                                      </select>
                                   </div>
                                   <div class="chk_button_sec">
                                      <a href="javascript:void(0)" class="btn-edit btn-gift">{{ trans('text.edit') }}</a>
                                      @if($count>1)
                                        <a href="javascript:void(0)" data-pid="{{ $cart->id}}" class="btn-send btn-gift">{{ trans('text.add_another') }}</a>
                                      @endif
                                   </div>
                  
                                   <div class="form_listing">
                                    @if(Auth::check())
                                      <?php $u_address = Auth::user()->first_name." ".Auth::user()->last_name."\r\n".Auth::user()->direction."\r\n".Auth::user()->flat." ".Auth::user()->dep."\r\n".Auth::user()->district;?>
                                    @else
                                      <?php $u_address =  Session::get('guest.f_name')[0]." ".Session::get('guest.l_name')[0]."\r\n".Session::get('guest.direction')[0]."\r\n".Session::get('guest.flat')[0]." ".Session::get('guest.dep')[0]."\r\n".Session::get('guest.district')[0];?>
                                    @endif
                                      <textarea rows="5" cols="30" name="giftAddress_gift[{{ $cart->id }}][]" class="disabled-field" required>{{ $u_address }}
                                      </textarea>
                                      <div class="del_wrapper">
                                         <label>{{ trans('text.delivery_type') }}:</label>
                                         <div class="del_row1">
                                            <input type="radio" value="express" name="giftshipping_gift[{{ $cart->id}}][]" checked required/>
                                            <p><em>Express</em> <span>(X S/. )</span></p>
                                         </div>
                                         <div class="del_row1">
                                            <input type="radio" value="priority" name="giftshipping_gift[{{ $cart->id}}][]" required/>
                                            <p><em>{{ trans('text.priority') }}</em>  <span>(X S/. )</span></p>
                                         </div>
                                         
                                      </div>
                                      
                                   </div>
                                   
                                   <div class="checkout_form">
                                      <div class="field_row">
                                         <input class="datepicker" name="date_gift[{{ $cart->id}}][]" type="text" class="field1" placeholder="{{ trans('text.date') }}" required/>
                                          
                                      </div>
                                      <div class="field_row">
                                         <input type="text" name="from_gift[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.para')}}" />
                                         <input type="text" name="to_gift[{{ $cart->id}}][]" class="field12" placeholder="{{ trans('text.para')}}" />
                                      </div>
                                      <div class="field_row">
                                         <textarea name="msg_gift[{{ $cart->id}}][]" placeholder="{{ trans('text.per_msg')}}" ></textarea>
                                      </div>
                                      
                                   </div>
                                </div>
                                @endif

                              @endforeach
                                
                           </div>
                       </div>
                       
                       <div class="col-md-3 col-sm-6">
                           
                           <div class="mod-of-pay">
                               <h3>{{ trans('text.payment_method') }}</h3>
                               
                              
                               <div class="pay_row">
                                 <div class="mad_pay_row" style="opacity: .5;pointer-events: none;">
                                    <input type="radio" name="payment_gateway" value="pago" required/>
                                    <div class="m_payment_content">
                                        <img src="{{ asset('images/payment1.png') }}" alt="" />
                                        <a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<p>{{ trans('text.payment_method_text') }}</p>"><img src="{{ asset('images/orange_questionmark.png') }}" alt="" /></a>
                                        
                                    </div>
                                 </div>
                                 
                                 <div class="mad_pay_row culqi">
                                    <input type="radio" name="payment_gateway" value="culqi" required checked/>
                                    <div class="m_payment_content">
                                        <img src="{{ asset('images/payment2.png') }}" alt="" />&nbsp;<img src="{{ asset('images/payment3.png') }}" alt="" />&nbsp;<img src="{{ asset('images/payment4.png') }}" alt="" />
                                        <a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<p><img src='{{ asset('images/culqi_tooltip.png') }}' alt='' style='width:280px;height:300px;'/></p>"><img src="{{ asset('images/orange_questionmark.png') }}" alt="" /></a>
                                        
                                    </div>
                                 </div>


                                 <div class="mad_pay_row">
                                    <input type="radio" name="payment_gateway" value="agente_bcp" required/>
                                    <div class="m_payment_content">
                                        <img src="{{ asset('images/bcp_agente.png') }}" alt="" />
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
                                    <input type="checkbox" name="accept_terms" value="1" checked required/>
                                    
                                    <div class="m_payment_content">
                                        <p>{{ trans('text.i_accept') }} <a href="{{ route('terms_n_conditions') }}">{{ trans('text.terms_n_conditions') }}</a>.<!-- , <a href="#">{{ trans('text.privacy_policy')}}</a>, {{ trans('text.and') }} <a href="#">{{ trans('text.shipping_conditions') }}</a> --></p>
                                    </div>
                                 </div>
                                 
                                {{--  <div class="mad_pay_row">
                                  <label>{{ trans('text.account_address') }}</label>
                                    <input type="text" name="mode-of-payment" />
                                 </div> --}}
                               
                               
                                <input id="btn_pago" type="button" value="{{ trans('text.buy') }}" class="btn btn-success" />
                                
                               </div>
                              
                               
                           </div>
                           
                       </div>
                       
                       <div class="col-md-4 col-sm-6 pcompare">
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
                                                <div class="col-md-1 col-sm-1 col-xs-1"><span class="fa fa-at"></span></div>
                                                  <div class="col-md-11 col-sm-11 col-xs-11">
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
                                                <div class="col-md-1 col-sm-1 col-xs-1"><span class="fa fa-envelope"></span></div>
                                                  <div class="col-md-11 col-sm-11 col-xs-11">
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
                                <div class="paytotal_price">{{ trans('text.total_price') }}:   <span>S/. {{ $total_price }}</span></div>
                                <?php 
                                $pri = explode('.', $total_price);
                                $pay_price = $pri[0];
                                if(isset($pri[1]))
                                {
                                  $pay_price = $pay_price.$pri[1];
                                }else{
                                  $pay_price = $pay_price.'00';
                                }
                                 ?>
                                <input type="hidden" name="qty" value="{{ $total_qty }}"> 
                                <input type="hidden" name="price" value="{{ $pay_price }}">
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
                                    <input class="cart_form2int inputbtn1" type="text" id="f-name" name="f-name" placeholder="Nombre" value="{{ Auth::user()->first_name }}" required/>
                               </div>
                               <div class="form_row">
                                    <input class="cart_form2int inputbtn1" type="text" id="l-name" name="l-name" placeholder="Apellido" value="{{ Auth::user()->last_name }}" required/>
                              </div>
                              
                               
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn1" type="text" id="direction" name="direction" value="{{ Auth::user()->direction }}" placeholder="Dirección" required/>
                               </div>
                               
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="district" name="district" value="{{ Auth::user()->  district }}" placeholder="Distrito" required/>
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="city" name="city" placeholder="Ciudad" value="{{ Auth::user()->city }}" required/>
                                 
                               </div>

                                <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="phone" name="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}" required/>
                                 
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

@stop


@section('footer_script')
<?php
echo utf8_decode("<script src=\"https://integ-pago.culqi.com/api/v1/culqi.js\"></script>
             
          
           <script>checkout.codigo_comercio = \"jsC0mty7lDYj\";
                    checkout.informacion_venta = \"$informacionVenta\";
                  
                   
              $('#btn_pago').on('click', function(e) {checkout.abrir();e.preventDefault();});
              function culqi (checkout) {
              $.ajax({
                  url: '".route("culqi_ipn")."',
                  type: \"POST\",
                  contentType: \"application/json\",
                  data: JSON.stringify(
                      {
                        'respuesta' : checkout.respuesta
                      }),
                  success: function(data){
                                  console.log(data);
                    var obj = JSON.parse(data);
                    var respuesta_venta = obj[\"codigo_respuesta\"];
                    if (respuesta_venta == \"venta_exitosa\") {
                      location.href='".route("order_success", array($order_number))."';
                      console.log('succes');
                    } else if (respuesta_venta == \"comercio_invalido\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.comercio_invalido') ."');
                      $( '#modal-culqi-error').modal();
                    } else if (respuesta_venta == \"parametro_invalido\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.parametro_invalido') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"expiracion_invalida\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.expiracion_invalida') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"cvv_invalido\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.cvv_invalido') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"operacion_denegada\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.operacion_denegada') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"fondos_insuficientes\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.fondos_insuficientes') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"contactar_emisor\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.contactar_emisor') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"error_procesamiento\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.error_procesamiento') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"tarjeta_perdida\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.tarjeta_perdida') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"tarjeta_robada\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.tarjeta_robada') ."');
                      $( '#modal-culqi-error').modal();
                    }else if (respuesta_venta == \"tarjeta_vencida\") {
                      $('#modal-culqi-error .modal-body .alert').html('". trans('text.tarjeta_vencida') ."');
                      $( '#modal-culqi-error').modal();
                    }else {
                      $('#modal-culqi-error .modal-body .alert').html(obj[\"mensaje_respuesta_usuario\"]);
                      $( '#modal-culqi-error').modal();
                      console.log('else');
                    }
                  },
                  error:function( ){
                    console.log('error');
                  }
                });
              // console.log(checkout.respuesta);
               checkout.cerrar();
               };
        </script>");
?>

@stop
