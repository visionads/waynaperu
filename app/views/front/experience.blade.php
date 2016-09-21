@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')
        <!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="como-toggle">
            <ul class="categories">
                <h2 class="sidebar-brand"> {{ trans('text.categories') }}</h2>
                @foreach($categories as $category)
                    <li>
                        <span class="gas" style="background-image:url({{ asset('uploads/categories/'.$category->icon) }})"></span>
                        <a href="#">{{ $category->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="page_paggination">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ trans('text.home') }}</a></li>
                        <li>
                            <a href="{{ route('category', array( Str::slug($cat->title), $cat->id ) ) }}">{{ $cat->title }}</a>

                        </li>
                        <li class="active">{{ $p_content->title }}</li>
                    </ol>
                    @if(Input::has('search'))
                        <a class="back" href="#"><span class="breadcrum-back">{{ trans('text.back_to_search') }}</span></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="page_title">
                    <img class="icon_title" src="{{ asset('images/icon/adven-icon.png') }}" alt=""/>
                    <span>{{ $p_content->title }}</span>
                </div>
            </div>
        </div>
        <!--- Accodtion section -->
        <div class="collapse_wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row slider_wrapper-outer">
                        <div class="col-md-9">
                            <div class="col-md-8">
                                <div class="left-section">
                                    <div class="slider_wrapper">
                                        <!-- main slider carousel -->
                                        <div class="row">
                                            <div class="col-md-12" id="slider">
                                                <div class="slide-inner12" id="carousel-bounding-box">
                                                    <div id="myCarousel" class="carousel slide">
                                                        <!-- main slider carousel items -->
                                                        <div class="carousel-inner">
                                                            <?php $count = 0; ?>
                                                            @if(!empty($p_images))
                                                                @foreach($p_images as $image)
                                                                    <div class=" @if($count == 0)active @endif item" data-slide-number="{{ $count }}">
                                                                        <img src="{{ asset('uploads/products/'.$image->image) }}" alt="" class="img-responsive">
                                                                    </div>
                                                                    <?php $count++; ?>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <!-- main slider carousel nav controls -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/main slider carousl
                                        <!-- thumb navigation carousel -->
                                        <div class="col-md-12 hidden-sm hidden-xs" id="slider-thumbs">
                                            <a class="carousel-control left" href="#myCarousel" data-slide="prev"><img src="{{ asset('images/arrow_left.png') }}" alt="" /></a>
                                            <a class="carousel-control right" href="#myCarousel" data-slide="next"><img src="{{ asset('images/arrow_right.png') }}" alt="" /></a>
                                            <!-- thumb navigation carousel items -->
                                            <ul class="list-inline">
                                                <?php $count = 0; ?>
                                                @if(!empty($p_images))
                                                    @foreach($p_images as $image)
                                                        <li> <a id="carousel-selector-{{ $count }}" class=" @if($count == 0)selected @else img-responsive @endif">
                                                                <img src="{{ asset('uploads/products/thumbs/thumb_'.$image->image) }}" alt="" class="img-responsive">
                                                            </a></li>
                                                        <?php $count++; ?>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <div class="slide_content">
                                            {{ $p_content->description }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="payment_wrapper clearfix">
                                    <form action="{{ route('product_add') }}" method="post" id="product-add">
                                        <input type="hidden" name="type" id="type" value="">
                                        <input type="hidden" name="id" value="{{ $p_content->product_id }}">
                                        <input type="hidden" name="title" value="{{ $p_content->title }}">
                                        <input type="hidden" name="total_qty" id="total_qty" value="1">
                                        <input type="hidden" name="total_price" id="total_price" value="{{ $min_price }}">
                                        <div class="form_row text-center nopadding">
                                            <div class="select_row">
                                                <label>{{ trans('text.place')}}:</label>
                                                @if(isset($first_loc))
                                                    <select id="basic" name="location" class="selectpicker form-control">
                                                        <option value="">{{ trans('text.select_location') }}</option>
                                                        <option value="{{ $first_loc->id }}">{{ $first_loc->name }}</option>
                                                        @if(!empty($locations))
                                                            @foreach($locations as $location)
                                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @else
                                                    <select id="basic" name="location" class="selectpicker form-control">
                                                        <option value="">{{ trans('text.select_location') }}</option>
                                                        @if(!empty($locations))
                                                            @foreach($locations as $location)
                                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @endif
                                            </div>
                                            <p><strong>{{ trans('text.personalize_your_exp') }}</strong> {{ trans('text.in_next_step') }}</p>
                                            <div class="row count_loc">
                                                <div class="col-md-6 text-center">
                                                    <div class="select_row small2">
                                                        <span style="font-size:13px">{{ trans('text.experience_pin_adult') }}:</span><br>
                                                        <a class="tooltip-text" href="javascript:void(0)" data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='contact-popup'><h3>Email</h3><p>{{ trans('text.tooltip_content1') }}</p></div>"></a>

                                                        <select id="pdf-price" name="pdf" class="selectpicker form-control" disabled>
                                                            @for($i=0; $i <= 10; $i++)
                                                                <option value="{{ $i }}" @if($i==1) selected @endif>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                        <em></em>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 text-center {{ ($child_price > 0) ? '' : 'hidden' }}">
                                                    <div class="select_row small2">
                                                        <span style="font-size:13px">{{ trans('text.experience_pin_boy') }}:</span><br>
                                                        <a class="tooltip-text" href="javascript:void(0)" data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='contact-popup'><h3>Mail</h3><p>{{ trans('text.tooltip_content2') }}</p></div>"></a>

                                                        <select id="mail-price" name="mail" class="selectpicker form-control" disabled>
                                                            <option value="0">0</option>
                                                            @for($i=1; $i <= 10; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                        <em></em>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 text-center hidden">
                                                    <div style="pointer-events:none;" class="select_row small2">
                                                        <a class="tooltip-text" href="javascript:void(0)" data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='contact-popup'><h3>Gift</h3><p>{{ trans('text.tooltip_content3') }}</p></div>"><span class="fa fa-gift"></span></a>

                                                        <select id="gift-price" name="gift" class="selectpicker form-control" disabled>
                                                            <option value="0">0</option>
                                                            @for($i=1; $i <= 10; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                        <em></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <h2 class="pricet">
                                                <span>{{ trans('text.exp_price') }}:</span>
                                                <span>{{ $min_price }}</span>
                                            </h2>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btn-danger cart-btn btn-block" disabled>
                                                        <span class="fa fa-shopping-cart"></span>{{ trans('text.add_to_cart') }}
                                                    </button>
                                                    <button class="btn btn-success checkout-btn btn-block" disabled>
                                                        <span class="fa fa-dollar"></span>{{ trans('text.buy') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @if($p->is_lead != '1')
                                            <div class="form_row text-center">
                                                <ul class="payments_methods clearfix">
                                                    <li>
                                                        <img src="{{ asset('images/pay_visa.png') }}" alt="Visa" width="50" height="30" />
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('images/pay_mastercard.png') }}" alt="Mastercard" width="40" />
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('images/pay_dinersclub.png') }}" alt="Diners Club" width="40" />
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('images/pay_amex.png') }}" alt="American Express" width="40" />
                                                    </li>
                                                    <li>
                                                        <img src="{{ asset('images/pay_bcpagente.png') }}" alt="BCP Agente" width="40" />
                                                    </li>
                                                </ul>
                                           </div>
                                        @endif
                                    </form>
                                </div>
                                <div class="col-lg-12">
                                    <ul class="list-inline">
                                        <li>
                                            <a class="exp_facebookvp" href="https://www.facebook.com/sharer/sharer.php?u={{ route('category_experience_id', array(Str::slug($category->title), Str::slug($p_content->title), $p_content->product_id)) }}" target="_blank">
                                                <img src="{{ asset('images/facebook.png') }}" alt="facebook" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="accordion" id="accordion1">
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle vp_collapse" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne" aria-expanded="true">
                                                {{ trans('text.details') }} <span class="arrow1"></span> </a>
                                        </div>
                                        <div id="collapseOne" class="accordion-body collapse in" >
                                            <div class="accordion-inner">

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        @if(isset($loc))
                                                            <?php
                                                            $loc_details = json_decode($loc->details);
                                                            ?>
                                                            @if(!empty($loc_details))
                                                                @foreach($loc_details as $key => $value)
                                                                    <div class="col-md-5">
                                                                        <p>
                                                                            <strong>{{ $key }}: <br/></strong>

                                                                        </p>
                                                                        <?php $detail_lists = explode("//",$value); ?>
                                                                        <ul>
                                                                            @foreach($detail_lists as $detail_list)
                                                                                <li style="margin-bottom:5px;">{{ $detail_list }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapsethree">
                                                {{ trans('text.frequent_questions') }} <span class="arrow1"></span> </a>
                                        </div>
                                        <div id="collapsethree" class="accordion-body collapse" style="height: 0px;">
                                            <div class="accordion-inner inner_content">
                                                <!-- Experince Faq -->
                                                <h6>{{ trans('text.category_one_exp') }}:</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="accordion" id="accordion2">
                                                            <?php $count = 1; ?>
                                                            @if(!empty($e_faqs))
                                                                @foreach($e_faqs as $faqs)
                                                                    <div class="accordion-group">
                                                                        <div class="accordion-heading">
                                                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#efaq-{{$count}}">
                                                                                {{ $faqs->que }} <span class="arrow2"></span> </a>
                                                                        </div>
                                                                        <div id="efaq-{{$count}}" class="accordion-body collapse" style="height: 0px;">
                                                                            <div class="accordion-inner">
                                                                                <p>{{ $faqs->ans }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php $count++; ?>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- General Faq -->
                                                <h6>{{ trans('text.category_general') }}:</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="accordion" id="accordion2">
                                                            <?php $count = 1; ?>
                                                            @if(!empty($g_faqs))
                                                                @foreach($g_faqs as $faqs)
                                                                    <div class="accordion-group">
                                                                        <div class="accordion-heading">
                                                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#gfaq-{{$count}}">
                                                                                {{ $faqs->que }} <span class="arrow2"></span> </a>
                                                                        </div>
                                                                        <div id="gfaq-{{$count}}" class="accordion-body collapse" style="height: 0px;">
                                                                            <div class="accordion-inner">
                                                                                {{ $faqs->ans }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php $count++; ?>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- BO Recommendations  -->
                            <div class="bloque review_wrapper">
                                <h3>{{ trans('text.recommend') }}</h3>
                                <div class="row">
                                    @if(!empty($products))
                                        @foreach($products as $product)
                                            <div class="item-grid item-grid-full">
                                                <a href="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($product->product_title), $product->product_id)) }}" title="{{ $product->product_title }}">
                                                    <div class="bloque-box">
                                                        <div class="bloque-image">
                                                            <img src="{{ asset('uploads/products/'.$product->image) }}" alt="blog" class="img-responsive">
                                                        </div>
                                                        <div class="bloque-caption">
                                                            <div class="bloque-caption-text">
                                                                <h2>{{ str_limit($product->product_title, $limit = 20, $end = '...') }}</h2>
                                                                <span class="bdr"></span>
                                                                <div class="clearfix"></div>
                                                                <p class="price">{{ getLocPrice($product->product_id) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- EO Recommendations-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- Accodtion section -->
    </div>
</div>
<!-- /#page-content-wrapper -->
<!-- MODAL -->
@if($p->is_lead == '1')
    <div class="modal fade" id="modal-lead-form" tabindex="-1" role="dialog" aria-labelledby="modal-culqi-button-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 register">
                            <div class="user_title"><strong>{{ trans('text.leads_heading') }}</strong></div>
                            {{  Form::open(array('route' => 'contact_provider', 'class' => 'registration-form fomrm_left col-md-8')) }}
                            {{-- <p>{{ trans('text.still_not_register') }}<br/>
                                {{ trans('text.please') }}, <span>{{ trans('text.register') }}.</span></p>--}}

                            <div class="form-group">
                                <label class="sr-only" for="lead_name">{{ trans('text.lead_name') }}</label>
                                <input type="text" name="lead_name" placeholder="{{ trans('text.lead_name') }}" class="form-lead_name form-control" id="form-lead_name" value="{{ Input::old('lead_name') }}" required>
                                @if ($errors->has('lead_name'))
                                    <div class="alert alert-danger" role="alert">{{ $errors->first('lead_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="lead_email">{{ trans('text.lead_email') }}</label>
                                <input type="text" name="lead_email" placeholder="{{ trans('text.lead_email') }}" class="form-lead_email form-control" id="form-lead_email" value="{{ Input::old('lead_email') }}" required>

                                @if ($errors->has('lead_email'))
                                    <div class="alert alert-danger" role="alert">{{ $errors->first('lead_email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="lead_phone">{{ trans('text.lead_phone') }}</label>
                                <input type="text" name="lead_phone" placeholder="{{ trans('text.lead_phone') }}" class="form-lead_phone form-control" id="form-lead_phone" value="{{ Input::old('lead_phone') }}" required>
                                @if ($errors->has('lead_phone'))
                                    <div class="alert alert-danger" role="alert">{{ $errors->first('lead_phone') }}</div>
                                @endif

                            </div>
                            <div class="mad_pay_row  form-group">
                                <input type="checkbox" name="is_newsletter" value="1" />

                                <div class="m_payment_content">
                                    <p>{{ trans('text.is_newsletter') }} .</p>
                                </div>
                            </div>
                            <div class="mad_pay_row  form-group">
                                <input type="checkbox" name="leads_terms" value="1" required/>

                                <div class="m_payment_content">
                                    <p>{{ trans('text.leads_terms') }} .</p>
                                </div>
                            </div>
                            <input type="hidden" name="p_id" value="{{ $p->id }}" style="display:none;" >
                            <input type="hidden" id="loc_idd" name="loc_id" value="@if(isset($first_loc)){{ $first_loc->id }}@endif" style="display:none;" >

                            <div><button type="submit" class="btn btn-success">{{ trans('text.lead_send') }}</button></div>

                            {{ Form::close() }}
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-lead-provider" tabindex="-1" role="dialog" aria-labelledby="modal-culqi-button-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 register">
                            <h3>{{ trans('text.provider_heading') }}</h3>
                            <div class="user_title"><strong>{{ trans('text.provider_subheading') }}</strong></div>


                            <div class="form-group col-md-8">

                                <input type="text" name="lead_name" placeholder="{{ trans('text.lead_name') }}" class="form-lead_name form-control" id="form-lead_name" value="{{ $p->lead_name }}" required>

                            </div>
                            <div class="form-group col-md-8">

                                <input type="text" name="lead_email" placeholder="{{ trans('text.lead_email') }}" class="form-lead_email form-control" id="form-lead_email" value="{{ $p->lead_email }}" required>

                            </div>
                            <div class="form-group col-md-8">

                                <input type="text" name="lead_phone" placeholder="{{ trans('text.lead_phone') }}" class="form-lead_phone form-control" id="form-lead_phone" value="{{ $p->lead_phone }}" required>

                            </div>
                            <div class="form-group col-md-8">

                                <input type="text" name="lead_address" placeholder="{{ trans('text.lead_phone') }}" class="form-lead_phone form-control" id="form-lead_phone" value="{{ $p->lead_address }}" required>

                            </div>


                            <p class="col-md-12">{{ trans('text.provider_text') }}</p>


                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
@stop

@section('meta')
<!-- for Facebook -->
<meta property="og:title" content="{{{ $p_content->title }}}" />
<meta property="og:type" content="article" />
<meta property="og:image" content="{{ asset('uploads/products/'.$p_images[0]->image) }}" />
<meta property="og:url" content="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($p_content->title), $p_content->product_id)) }}" />
<meta property="og:description" content="{{ $p_content->mini_description }}" />

@stop


@section('footer_script')
    @if(Session::get('msg') == 'Successfull')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal-lead-provider').modal('show');
            });
        </script>
    @elseif(Session::get('msg') == 'fail')
        <script type="text/javascript">
            $(document).ready(function() {
                $('#modal-lead-form').modal('show');
            });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            $('.lead-btn').click(function(e){$('#modal-lead-form').modal('show');e.preventDefault();});
            $('.cart-btn').removeAttr('disabled');
        })
    </script>
@stop
