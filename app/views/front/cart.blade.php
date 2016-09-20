@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')
        <!-- Page Content -->
<div class="checkout_wrapper-main">
    <div class="container-fluid">
        <div class="checkout_wrapper">
            <div class="cart_top_row row">
                <div class="container">
                    <div class="col-md-3 col-sm-2">
                        <a class="cart_back_home" href="{{ route('home') }}"><span class="fa fa-home"></span>{{ trans('text.back_to_home') }}</a>
                    </div>
                    <div class="col-md-6 col-sm-8">
                        <ul class="cart_page_listing">
                            <li class="active_cart">{{trans('text.my_cart')}}</li>
                            <li>{{trans('text.personalization')}}</li>
                            <li>{{trans('text.Shipping_n_payment')}}</li>
                            <li>{{trans('text.thank_you')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cart-row">

                <div class="container">

                    <div class="col-md-9 col-sm-12">
                        <?php $total_price = 0;?>
                        @foreach($cart_con as $cart)
                            <?php $total_price = $total_price + $cart->price; ?>
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="bloque-box">
                                        <div class="bloque-image">
                                            <!-- <span class="like-icon"></span> -->
                                            <img src="{{ asset('uploads/products/'.getLocImage($cart->options['loc_id'])) }}" alt="blog" class="img-responsive">
                                        </div>
                                        <div class="bloque-caption">
                                            <span class="icon " @if(getProIcon($cart->id) !='') style="background-image:url({{ asset('uploads/categories/'.getProIcon($cart->id)) }})"@endif>&nbsp;</span>
                                            <div class="bloque-caption-text">
                                                <h2>{{ getExpName($cart->id) }}</h2>
                                                <span class="bdr"></span>
                                                <div class="clearfix"></div>
                                                <p>{{ getMiniDes($cart->id) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="accept_catt">
                                        <div class="select_row">
                                            <label>{{ trans('text.place') }}:</label>
                                            <span class="location">{{ getLocName($cart->options['loc_id']) }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-3"></div>
                                            <div class="col-md-3 col-sm-3 col-xs-3 cartpp text-center">
                                                <div class="tick">
                                                    @if($cart->options['pdf'] > 0 )
                                                        <?php $count = $cart->options['pdf']; ?>
                                                        <img src="{{ asset('images/tick.png') }}" alt="" />
                                                    @else
                                                        <?php $count = 0; ?>
                                                    @endif
                                                </div>
                                                <div class="select_row small2" data-exqty="{{ $count }}" data-totalqty="{{ $cart->qty }}" data-product="pdf" data-pid="{{ $cart->id }}" data-locid="{{ $cart->options['loc_id'] }}">
                                                    <span style="font-size:13px">{{ trans('text.experience_pin_adult') }}:</span><br>
                                                    <select id="basicpdf" class="selectpicker form-control cart-selector">
                                                        @for($i=0; $i<=10; $i++)
                                                            @if($i==$count)
                                                                <option selected>{{ $i }}</option>
                                                            @else
                                                                <option>{{ $i }}</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    <br>
                                                    <em>S/. {{ getPdfPrice($cart->options['loc_id'], $cart->options['pdf']) }}</em>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3 cartpp text-center">
                                                <div class="tick">
                                                    @if($cart->options['mail'] > 0 )
                                                        <?php $count = $cart->options['mail']; ?>
                                                        <img src="{{ asset('images/tick.png') }}" alt="" />
                                                    @else
                                                        <?php $count = 0; ?>
                                                    @endif
                                                </div>
                                                <div class="select_row small2" data-exqty="{{ $count }}" data-totalqty="{{ $cart->qty }}" data-product="mail" data-pid="{{ $cart->id }}" data-locid="{{ $cart->options['loc_id'] }}">
                                                    <span style="font-size:13px">{{ trans('text.experience_pin_boy') }}:</span><br>
                                                    <select id="basicmail" class="selectpicker form-control cart-selector">
                                                        @for($i=0; $i<=10; $i++)
                                                            @if($i==$count)
                                                                <option selected>{{ $i }}</option>
                                                            @else
                                                                <option>{{ $i }}</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    <br>
                                                    <em>S/. {{ getMailPrice($cart->options['loc_id'], $cart->options['mail']) }}</em>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-3 cartpp text-center hidden">
                                                <div class="tick">
                                                    @if($cart->options['gift'] > 0 )
                                                        <?php $count = $cart->options['gift']; ?>
                                                        <img src="{{ asset('images/tick.png') }}" alt="" />
                                                    @else
                                                        <?php $count = 0; ?>
                                                    @endif
                                                </div>
                                                <div style="z-index: -99999;position: relative;" class="select_row small2" data-exqty="{{ $count }}" data-totalqty="{{ $cart->qty }}" data-product="gift" data-pid="{{ $cart->id }}" data-locid="{{ $cart->options['loc_id'] }}">
                                                    <span class="fa fa-gift"></span>
                                                    <select id="basicgift" class="selectpicker form-control cart-selector">
                                                        @for($i=0; $i<=10; $i++)
                                                            @if($i==$count)
                                                                <option selected>{{ $i }}</option>
                                                            @else
                                                                <option>{{ $i }}</option>
                                                            @endif
                                                        @endfor
                                                    </select>
                                                    <em>S/. {{ getGiftPrice($cart->options['loc_id'], $cart->options['gift']) }}</em>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="row cart_price_total">
                <div class="col-md-4 col-sm-4 col-xs-5">
                    <label>Total S/</label>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-7">
                    <span>{{ number_format($total_price, 2) }}</span>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5">
                    <label>{{ trans('text.with_coupon_code') }}:</label>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-7">
                    <strong>{{ number_format($total_price, 2) }}</strong>
                </div>
            </div>
            <div class="row proceed_next span15">
                <div class="col-md-4 col-sm-4 col-xs-5"><label>Total S/. </label></div>
                <div class="col-md-8 col-sm-8 col-xs-7">
                    <em>{{ number_format($total_price, 2) }}</em>
                    <a href="{{ route('home') }}" class="btn btn-default">{{ trans('text.continue_shopping') }}</a>
                    <a class="btn btn-primary" href="{{ route('login_checkout') }}">{{ trans('text.checkout') }}<span class="fa fa-angle-right"></span></a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->
<style type="text/css">
    @if (App::getLocale() == 'en')
            .resume_campare:before {
        content: 'Coming Soon...';
        font-weight: bold;
        top: 45%;
        position: absolute;
        left: 34%;
        font-size: 20px;
    }
    @else
            .resume_campare:before {
        content: 'Próximamente...';
        font-weight: bold;
        top: 45%;
        position: absolute;
        left: 34%;
        font-size: 20px;
    }
    @endif

</style>
@stop
