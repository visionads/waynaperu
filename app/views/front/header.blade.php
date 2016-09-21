@section('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Wayna new experiences for you">
    <!--<meta name="author" content="Wayna">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="google-site-verification" content="3Ynb2IvU8kTmk94I_jHyErZ_uUW1YYiCnliEz9CeBQ0" />
    <link href="https://plus.google.com/b/102907227481478617861/" rel="publisher">
    @if ( $__env->yieldContent('meta') )
        @yield('meta')
    @else
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Wayna" />
        <meta property="og:description" content="Tenemos las mejores actividades para salir de la rutina. Encuentra que hacer, los mejores full days y lugares turisticos para visitar cerca de Lima-Peru." />
        <meta property="og:image" content="{{ url('images/popup_facebook_share.jpg') }}" />
        <meta property="og:site_name" content="Wayna" />
        <meta property="article:author" content="Wayna" />
    @endif
    <meta property="fb:app_id" content="216753298705581"/>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/menu-sidebar.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="canonical" href="{{ url('/') }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>Wayna - New experiences for you!</title>
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PKJGK3"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PKJGK3');</script>
<!-- End Google Tag Manager -->
<div class="mobile-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!--  mobile menu -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand-centered">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand navbar-brand-centered"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="Wayna-logo"></a></div>

                <div class="right-side">
                    <ul class="nav navbar-nav ">
                        <li class="dropdown cart">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-shopping-cart"></span> <span class="circle">{{ Cart::count(false) }}</span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                @foreach(Cart::content() as $cart)

                                    <li>

                                       <span class="item">
                                       <span class="item-left">
                                       <img src="{{ asset('uploads/products/thumbs/thumb_'.getLocImage($cart->options['loc_id'])) }}" alt="" width="50px" height="50px"/>
                                       <span class="item-info">
                                       <span>{{ $cart->name }}</span>
                                       <span>S/. {{ $cart->price }}</span>
                                       </span>
                                       </span>
                                       <span class="item-right">
                                       <button class="btn btn-xs btn-danger pull-right" onclick="removeRow({{ $cart->rowid }})">x</button>
                                       </span>
                                       </span>
                                    </li>
                                @endforeach
                                <li class="divider"></li>
                                <li><a class="text-center" href="">{{ trans('text.view_cart') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-brand-centered">
                <div class="mobile_wrapper_t">
                    <h2 class="sidebar-brand"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#mobile-toggle2">{{ trans('text.categories') }}</a></h2>
                    <ul id="mobile-toggle2" class="categories accordion-body collapse" style="height: 0px;">
                        @foreach($categories as $category)
                            <li>
                                <span class="gas" style="background-image:url({{ asset('uploads/categories/'.$category->icon) }})"></span>
                                <a href="{{ route('category', array(Str::slug($category->title), $category->cat_id)) }}">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mobile_wrapper_t">
                    <h2 class="sidebar-brand"><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#mobile-toggle3">{{ trans('text.specials') }}</a></h2>
                    <ul id="mobile-toggle3" class="sidebar-nav esp accordion-body collapse" style="height: 0px;">
                        <li>
                            <a href="{{ route('special', array('for_two')) }}">{{ trans('text.specials_for_two') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('special', array('best_seller')) }}">{{ trans('text.specials_best_seller') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('special', array('with_discount')) }}">{{ trans('text.specials_with_discount') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('special', array('new')) }}">{{ trans('text.specials_new') }}</a>
                        </li>
                    </ul>
                </div>


                <!-- feature links -->
                <div class="feature_links_mobile">
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li @if(LaravelLocalization::getCurrentLocale() == $localeCode ) style="display:none;" @else style="display:block;" @endif>
                                <a rel="alternate" data-locale="{{$localeCode}}" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                    <i class="fa fa-question-circle"></i>
                                    <span>{{ trans('text.change_lang') }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li>
                            <a href="{{ route('faq_front') }}">
                                <i class="fa fa-question-circle"></i>
                                <span>{{ trans('text.faq') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wayna_work') }}">
                                <i class="fa fa-user"></i>
                                <span>{{ trans('text.how_wayna_work') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="launch-modal" data-modal-id="modal-register">
                                <i class="fa fa-user"></i>
                                <span>{{ trans('text.login_btn_text') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-phone"></i>
                                <span>{{ trans('text.contact') }}</span>
                            </a>
                        </li>
                    </ul>

                    <address>
                        <em>{{ trans('text.phone_number') }}</em>
                        <span>{{ trans('text.timing') }}</span>
                        <a href="mailto:info@waynaperu.com">info@waynaperu.com</a>
                    </address>

                </div>
                <!-- feature links -->



            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>
<header class="navbar" id="top_head">
    <div class="container-fluid">
        <div class="logo">
            <a href="{{ route('home') }}"> <img src="{{ asset('images/logo.png') }}" alt="Wayna-logo"> </a>
        </div>
        <!--logo end here-->
        <div class="search-bar">
            <div class="input-group stylish-input-group">
                {{ Form::open(array('route' => 'search', 'method' => 'get', 'id'=>'search_form'))}}
                <span class="input-group-addon">
                  <button type="submit">
                      <span class="glyphicon glyphicon-search"></span>
                  </button>
                  <input type="text" class="form-control search" id="q" name="q" placeholder="{{ trans('text.search_text') }}" value="<?php if(Input::has('q')){ echo Input::get('q');}?>" autocomplete="off"  >
                  <div id="result"></div>
                  </span>
                {{ Form::close() }}
            </div>
        </div>
        <!--search bar end here-->
        <div class="slogen">
            <span>{{ trans('text.search_slogen') }}</span>
        </div>
        <!--slogen end here-->
        <div class="right-side">
            <ul class="nav navbar-nav ">
                <li class="dropdown cart">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-shopping-cart"></span> <span class="circle">{{ Cart::count(false) }}</span></a>
                    <ul class="dropdown-menu dropdown-cart" role="menu">
                        @foreach(Cart::content() as $cart)
                            <li>
                           <span class="item">
                           <span class="item-left">
                           <img src="{{ asset('uploads/products/thumbs/thumb_'.getLocImage($cart->options['loc_id'])) }}" alt="" width="50px" height="50px"/>
                           <span class="item-info">
                           <span>{{ $cart->name }}</span>
                           <span>S/. {{ $cart->price }}</span>
                           </span>
                           </span>
                           <span class="item-right">
                           <button class="btn btn-xs btn-danger pull-right" onclick="removeRow('{{ $cart->rowid }}')">x</button>
                           </span>
                           </span>
                            </li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a class="text-center" href="{{ route('cart') }}">{{ trans('text.view_cart') }}</a></li>
                    </ul>
                </li>
                <li><a class="text-center" href="{{ route('faq_front') }}">{{ trans('text.faq') }}</a></li>
                <li>
                    <div class="btn-group en">
                        <button class="btn btn-default darkgray landuage-text" data-toggle="dropdown" type="button">{{ LaravelLocalization::getCurrentLocale() }}</button>
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"><span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="landuage-text" rel="alternate" data-locale="{{$localeCode}}" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                        {{{ $localeCode }}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="bdr"><img src="{{ asset('images/blog/bdr.png') }}" alt="bdr"></li>
                <li>
                    @if (Auth::check())
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">{{ Auth::user()->username }}</button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('account') }}">{{ trans('text.my_account') }}</a></li>
                            <li><a href="{{ route('site_logout') }}">{{ trans('text.logout') }}</a></li>
                        </ul>
                    @else
                        <div class="btn"><button class="btn btn-danger orange ing launch-modal" data-modal-id="modal-register">{{ trans('text.login_btn_text') }}</button></div>
                    @endif
                </li>
            </ul>
        </div>
        <!--right side end here-->
    </div>
</header>
<!--header end here-->
@stop
