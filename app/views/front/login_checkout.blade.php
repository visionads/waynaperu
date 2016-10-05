@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')
    <!-- Page Content -->
         <div class="checkout_wrapper-main">
            <div class="container-fluid">
                <div class="checkout_wrapper">
                     <div class="cart_top_row row bdr_none">
                        <div class="col-md-3 col-sm-2 mobile-hide">&nbsp; </div>
                        <div class="col-md-6 col-sm-8">
                             <ul class="cart_page_listing">
                                <li class="complete">{{ trans('text.my_cart') }}</li>
                                <li class="active_cart">{{ trans('text.personalization') }}</li>
                                <li>{{ trans('text.Shipping_n_payment') }}</li>
                                <li>{{ trans('text.thank_you') }}</li>
                             </ul>
                        </div>
                        <div class="col-md-3 col-sm-2 mobile-hide text-right">&nbsp; </div>
                      </div>

                   <div class="row">

                       <div class="col-md-3 col-sm-12">
                           @include('admin.theme.errormessage')
                           <div class="checkout_form2">
                               <h2>{{ trans('text.personalization') }}</h2>
                               {{  Form::open(array('route' => 'client-login-checkout', 'class' => 'cart_form2')) }}
                               <h5>{{ trans('text.ret_customer') }}</h5>
                               <p>{{ trans('text.checkout_login') }}</p>
                               @if(Auth::check())
                                 {{ Auth::user()->email }}
                               @else
                                <div class="form_row">
                                 <input class="cart_form2int" type="text" id="email" name="email" placeholder="Email or Username"/>
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int" type="password" id="password" name="password" placeholder="{{ trans('text.password') }}"/>
                                 {{--@if ($errors->has('login-password'))--}}
                                      {{--<div class="alert alert-danger" role="alert">{{ $errors->first('login-password') }}</div>--}}
                                  {{--@endif--}}
                                 <span class="msg1">{{ trans('text.checkout_forget_pswd') }}</span>
                               </div>
                               <input type="submit" name="login" value="{{ trans('text.login_btn_text') }}" class="btn btn_login"/>
                               {{ Form::close() }}
                               @endif
                           </div>
                       </div>
                       <div class="checkout_login col-md-5 col-sm-6">
                           <div class="client_login">
                             <h4>{{ trans('text.new_client') }}</h4>
                             <p>{{ trans('text.checkout_register') }}</p>
                             {{  Form::open(array('route' => 'process_guest_checkout', 'class' => 'client_login_form')) }}
                               <div class="form_row">
                                    <input class="cart_form2int inputbtn1" type="text" id="f-name" name="f-name" placeholder="{{ trans('text.first_name') }}" value="{{ Input::old('f-name') }}"/>
                                    @if ($errors->has('f-name')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('f-name') }}</div> 
                                    @endif
                               </div>
                               <div class="form_row">
                                    <input class="cart_form2int inputbtn1" type="text" id="l-name" name="l-name" placeholder="{{ trans('text.surname') }}" value="{{ Input::old('l-name') }}"/>
                                    @if ($errors->has('l-name')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('l-name') }}</div> 
                                    @endif
                              </div>
                              <div class="form_row">
                                 <input class="cart_form2int inputbtn1" type="text" id="email" name="email" placeholder="Email" value="{{ Input::old('email') }}"/>
                                 @if ($errors->has('email')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('email') }}</div> 
                                  @endif
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="passport" name="passport" placeholder="{{ trans('text.id_passport') }}"  value="{{ Input::old('passport') }}"/>
                                 @if ($errors->has('passport')) 
                                      <div class="alert alert-danger" role="alert">{{ $errors->first('passport') }}</div> 
                                  @endif
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn1" type="text" id="direction" name="direction" placeholder="{{ trans('text.address') }}" value="{{ Input::old('direction') }}"/>
                                 @if ($errors->has('direction')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('direction') }}</div> 
                                  @endif
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn3" type="text" id="flat" name="flat" placeholder="{{ trans('text.floor') }}" value="{{ Input::old('flat') }}"/>
                                 @if ($errors->has('flat')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('flat') }}</div> 
                                  @endif
                                 <input class="cart_form2int inputbtn3" type="text" id="dep" name="dep" placeholder="{{ trans('text.department') }}" value="{{ Input::old('dep') }}"/>
                                 @if ($errors->has('dep')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('dep') }}</div> 
                                  @endif
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="district" name="district" placeholder="{{ trans('text.districtt') }}" value="{{ Input::old('district') }}"/>
                                 @if ($errors->has('district')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('district') }}</div> 
                                  @endif
                               </div>
                               <div class="form_row">
                                 <input class="cart_form2int inputbtn2" type="text" id="city" name="city" placeholder="{{ trans('text.city') }}" value="{{ Input::old('city') }}"/>
                                 @if ($errors->has('city')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('city') }}</div> 
                                  @endif
                                 <input class="cart_form2int inputbtn2" type="text" id="province" name="province" placeholder="{{ trans('text.province') }}" value="{{ Input::old('province') }}"/>
                                 @if ($errors->has('province')) 
                                        <div class="alert alert-danger" role="alert">{{ $errors->first('province') }}</div> 
                                  @endif


                               </div>
                               <div class="form_row">
                                  <input class="cart_form2int inputbtn2" type="text" id="phone" name="phone" placeholder="{{ trans('text.phone') }}" value="{{ Input::old('phone') }}"/>
                                  <p>{{ trans('text.phone_msg') }}</p>
                                   @if ($errors->has('phone')) 
                                          <div class="alert alert-danger" role="alert">{{ $errors->first('phone') }}</div> 
                                  @endif
                                </div>
                              <input type="submit" name="continue" value="{{ trans('text.continue') }}" class="btn btn_login"/>
                             {{ Form::close() }}
                               <div class="socail_login">
                                 <a href="{{ URL::route('facebook_login','checkout') }}"><img src="{{ asset('images/facebook-btn.png') }}" alt="" /></a>
                                 <a href="{{ URL::to('google/authorize') }}"><img src="{{ asset('images/google+.png') }}" alt="" /></a>
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
                                    <h3>{{ $cart->name }}<br> #18739283</h3>
                                       <?php $total_price = $total_price + $cart->price; 
                                              $total_qty = $total_qty + $cart->qty;
                                       ?>                                 
                                    <div class="row row_content">
                                       <div class="col-md-4 col-sm-4 col-xs-4"><img class="img-responsive" src="{{ asset('uploads/products/thumbs/thumb_'.getLocImage($cart->options['loc_id'])) }}" alt="" /></div>
                                       <div class="col-md-8 col-sm-8 col-xs-8">

                                            @if($cart->options['pdf'] > 0 )
                                             <div class="pay_pro_row row">
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                  <span style="font-size:13px">{{ trans('text.experience_pin_adult') }}:</span><br>
                                                </div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                                     <div class="row">
                                               	      <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <div class="row">
                                                          <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $cart->options['pdf'] }} x {{ getLocName($cart->options['loc_id']) }}</p></div>
                                                          <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. {{ getPdfPrice($cart->options['loc_id'], $cart->options['pdf']) }}</span></div>
                                                       </div> 
                                                    </div>
                                                	 </div>
                                               	  </div>
                                            </div>
                                            @endif
                                            @if($cart->options['mail'] > 0 )
                                            <div class="pay_pro_row row">
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                  <span style="font-size:13px">{{ trans('text.experience_pin_boy') }}:</span><br>
                                                </div>
                                                  <div class="col-md-9 col-sm-9 col-xs-9">
                                                     <div class="row">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <div class="row">
                                                          <div class="col-md-6 col-sm-6 col-xs-6"><p>{{ $cart->options['mail'] }} x {{ getLocName($cart->options['loc_id']) }}</p></div>
                                                          <div class="col-md-6 col-sm-6 col-xs-6"><span>+ S/. {{ getMailPrice($cart->options['loc_id'], $cart->options['mail']) }}</span></div>
                                                       </div> 
                                                    </div>
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
                                                   </div>
                                                  </div>
                                             </div>
                                            @endif
                                       </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="paytotal_price">{{ trans('text.total_price') }}: 	<span>S/. {{ $total_price }}</span></div>
                            </div>
                          </div>
                       </div>
                   </div>
                </div>
            </div>
         </div>
         <!-- /#page-content-wrapper -->
@stop
