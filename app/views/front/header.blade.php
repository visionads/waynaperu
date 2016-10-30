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
    <!-- For Slider-->
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}">
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

    {{-- For Slider--}}
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ asset('slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,
                mobileFirst: true,
                //fade: true,
                focusOnSelect: true,
                waitForAnimate: true,
                verticalSwiping: true,
                lazyLoad:'progressive',
                easing:''
            });
        });
    </script>
    {{-- Slider End--}}
    <title>exploor.pe</title>
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
                <div class="navbar-brand navbar-brand-centered"><a href="/"><img src="{{ asset('images/logo.png') }}" alt="Exploor | Wayna Peru" width="40%"></a></div>

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
                        <a href="mailto:info@exploor.pe">info@exploor.pe</a>
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
                        <span class="glyphicon glyphicon-shopping-cart"></span> <span class="circle">{{ Cart::count(false) }}</span>
                    </a>
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
                <li><a class="text-center" href="https://waynaexp.wordpress.com/" target="_blank"> &nbsp;&nbsp; Blog</a></li>
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
                                        {{ $localeCode }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="bdr"><img src="{{ asset('images/blog/bdr.png') }}" alt="bdr"></li>
                <li>
                    @if (Auth::check() && Auth::user()->type=='client')
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('orders') }}">{{ trans('text.orders') }}</a></li>
                            <li><a href="{{ route('account') }}">{{ trans('text.my_account') }}</a></li>
                            <li><a href="{{ route('site_logout') }}">{{ trans('text.logout') }}</a></li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->type=='admin')
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin') }}">{{ trans('text.dashboard') }}</a></li>
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

{{--Slider Start--}}
<?php $page_name = Route::getCurrentRoute()->getName(); ?>
@if($page_name == 'home')
@if(isset($sliders) && is_object($sliders))
<div class="container-fluid" style=" padding: 0!important; margin: 0!important;">
    <div class="regular slider">
        @foreach($sliders as $slider)
        <div>
            <a href="@if(!empty($slider->url)) {{ $slider->url }} @else # @endif">
                <img class="img-responsive" src="{{ asset($slider->path) }}" alt="{{ $slider->caption }}">
            </a>
        </div>
        @endforeach
    </div>
    {{--<div class="regular slider">
        <div>
            <img src="{{ asset('images/slider/slide-1.jpg') }}">
        </div>
        <div>
            <img src="{{ asset('images/slider/slide-2.jpg') }}">
        </div>
        <div>
            <img src="{{ asset('images/slider/slide-3.jpg') }}">
        </div>
        <div>
            <img src="{{ asset('images/slider/slide-4.png') }}">
        </div>
    </div>--}}
</div>
@endif
@endif
{{--Slider End--}}
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
