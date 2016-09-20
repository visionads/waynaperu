 @extends('front.layout')

@extends('front.header')

@extends('front.footer')

@section('content')
 <!-- Page Content -->
         <div class="checkout_wrapper-main">
            <div class="container">
               
				<div class="checkout_wrapper">
                	
                  <div class="cart_top_row row">
                    <div class="col-md-3 col-sm-2"><h2 class="order_sucess">{{ trans('text.order_success') }} <img src="{{ asset('images/sucess.png') }}" alt="" /></h2></div>
                    <div class="col-md-6 col-sm-8">
                         <ul class="cart_page_listing">
                            <li class="complete">{{ trans('text.my_cart') }}</li>
                            <li class="complete">{{ trans('text.personalization') }}</li>
                            <li class="complete">{{ trans('text.Shipping_n_payment') }}</li>
                            <li class="active_cart">{{ trans('text.thank_you') }}</li>
                         </ul>
                    </div>
                    <div class="col-md-3 col-sm-2 mobile-hide text-right"></div>
                  </div>
                	
                   <div class="row">
                       <div class="col-md-9">
                          <div class="row">
                           	<div class="col-md-8 col-sm-8 col-xs-12">
                                
                                 <div class="sucess_-order_list">
                                      <h4>{{ trans('text.thanks_message') }}</h4>
                                      <h6>{{ trans('text.order_number') }}: {{ $order_number }}</h6>
                                      <div class="order_list_suss content-scroll mCustomScrollbar">
                                          @foreach($orders as $order)
                                           <div class="row span10">
                                                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                                    <img class="suss_product" src="{{ asset('uploads/products/thumbs/thumb_'.getLocImage($order->loc_id)) }}" alt=""  width="240px"/>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                     <h2>{{ getExpName($order->product_id) }}</h2>
                                                     
                                                     <div class="listing_pro23">
                                                      @if($order->pdf_qty > 0)
                                                         <div class="row">
                                                             <div class="col-md-2 col-sm-2 col-xs-2">
                                                               <span style="font-size:13px">{{ trans('text.experience_pin_adult') }}:</span>
                                                             </div>
                                                             <div class="col-ms-10 col-sm-10 col-xs-10"><p>{{ $order->pdf_qty  }} x {{ getLocName($order->loc_id) }} </div>
                                                         </div>
                                                         @endif
                                                         @if($order->mail_qty > 0)
                                                         <div class="row">
                                                             <div class="col-md-2 col-sm-2 col-xs-2">
                                                              <span style="font-size:13px">{{ trans('text.experience_pin_boy') }}:</span>
                                                             </div>
                                                             <div class="col-ms-10 col-sm-10 col-xs-10"><p>{{ $order->mail_qty }} x {{ getLocName($order->loc_id) }} </div>
                                                         </div>
                                                         @endif
                                                         @if($order->gift_qty > 0)
                                                         <div class="row">
                                                             <div class="col-md-2 col-sm-2 col-xs-2"><span class="fa fa-gift"></span></div>
                                                             <div class="col-ms-10 col-sm-10 col-xs-10"><p>{{ $order->gift_qty}} x {{ getLocName($order->loc_id) }} </div>
                                                         </div>
                                                         @endif
                                                         
                                                         
                                                         </div>
                                                         
                                                         
                                                     </div>
                                                </div>
                                           
                                           @endforeach
                                           
                                          
                                      </div>
                                 </div>
                                
                            </div>
                           	{{-- <div class="col-md-6 col-sm-6">
                                <div class="sucess_msg">
                                   <p><strong>Cree tu perfil ahora</strong> con tus datos has anadido y disfruta tu 
proxima experiencia por <span>S/.X</span> más barato
<em>Fácil cliquea "Save to profile" y entra tu username, contraseña y email.</em> </p>
									  <button class="btn btn_login">Save to profile</button>
                                      
                                </div>
                            </div> --}}
                          </div>
                          
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="scs_othr_detail">
                                       <p>{{ trans('text.order_confirmation_msg') }} </p>	
									   <div class="button_detail2">
                                           <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank"><img src="{{ asset('images/facebook_suc.png') }}" alt="" /></a>
                                           <a href="#"><img src="{{ asset('images/home.png') }}" alt="" /></a>
                                       </div>
                                  </div>
                              </div>
                          </div>
                          
                       </div>
                       <div class="col-md-3 col-sm-12 pcompare success_top34">
                           <div class="resume_campare">
                              <div class="cart_right cat_sucess">
                                    <h3>{{ trans('text.also_like_product') }} </h3>      
                                     
                                     <div class="pro_detail_sucess">    
                                        @foreach($products as $product)
                                         <a href="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($product->product_title), $product->product_id)) }}" title="{{ $product->title }}">
                                          <img src="{{ asset('uploads/products/thumbs/thumb_'.getExpImage($product->product_id)) }}" alt="" />
                                          </a>
                                          
                                        @endforeach
                                        <a class="btn btn_login" href="{{ route('home') }}">{{ trans('text.see_more') }}</a>
                                     </div>                     
                              </div>
                          </div>
                       </div>
                   </div>
                </div>
               
            </div>
         </div>
         <!-- /#page-content-wrapper -->

@stop

@section('meta')
<!-- for Facebook -->          
<meta property="og:title" content="Ordernumber: {{ $order_number }}" />
<meta property="og:type" content="article" />

<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:description" content="{{{ trans('text.order_confirmation_msg') }}}" />

@stop
