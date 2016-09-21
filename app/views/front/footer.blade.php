@section('footer')

    <div class="main_foo_content">
        <div class="main_footer_section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="footre_contact_add">
                            <h3><span>{{ trans('text.contact') }}</span></h3>
                            <h6>{{ trans('text.phone_number') }}</h6>
                            <p>{{ trans('text.timing') }} <br /> info@waynaperu.com</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <ul class="footer_listing">
                            <li><a href="https://www.facebook.com/waynaexp/info/?tab=page_info" target="_blank">{{ trans('text.who_we_are') }}</a></li>
                            <li><a href="{{ route('terms_n_conditions') }}">{{ trans('text.terms') }}</a></li>
                            {{-- <li><a href="#">{{ trans('text.policy') }}</a></li> --}}
                            <li><a class="nl" href="#" data-toggle="modal" data-target="#modal-newsletter">{{ trans('text.newsletter') }}</a></li>
                            <li><a href="https://waynaexp.wordpress.com/" target="_blank">Wayna Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="clearfix">
                                    <div class="col-md-5 text-right">
                                        <a href="#">
                                        <img src="{{ url('images/comodo_secure_seal_100x85_transp.png') }}">
                                        </a> &nbsp;
                                    </div>
                                    <div class="col-md-7 text-center">
                                        <br>
                                        <a href="http://www.up.edu.pe/aplicaciones/boletines/EmprendeUP/ver_articulo.aspx?idsec=630&idnum=42&utm_source=Icommarketing&utm_medium=Email&utm_content=Boletin%20t2%20120416%20fin&utm_campaign=Icommarketing%20-%20Emprende%20UP%20-%20Boletin%20t2%20120416">
                                            <img src="{{ url('images/logo_emprende_up.jpg') }}">
                                        </a>
                                        <div class="cpyrgt">@2016 Wayna</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /#page-content-wrapper -->
    <footer class="footer">
        <!-- main footer section  -->

        <!-- main footer section  -->

        <div class="container-fluid">
            <div class="col-md-2 col-sm-4 col-sm-offset-0 col-md-offset-3 col-lg-offset-5 footer-gray">
                <p class="text-muted">{{ trans('text.made_with') }} <span><img src="{{ asset('images/icon/footer-icon.png') }}"  alt="footer-icon"></span> {{ trans('text.in_lima') }}</p>
            </div>
            <div class="col-md-2 col-sm-4 footer-right">
                <ul>
                    <li class="contact"><a class="tooltip-text" href="#" data-toggle="tooltip" data-html="true" data-placement="top" title="<div class='contact-popup'><h3>{{ trans('text.contact') }}</h3><p>{{ trans('text.phone_number') }}<br/>{{ trans('text.timing') }}<br/>info@waynaperu.com</p></div>">{{ trans('text.contact') }}</a></li>
                    <li><a href="https://www.facebook.com/waynaexp/info/?tab=page_info" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/waynaexp " target="_blank"><i class="fa fa-twitter"></i></a></li>
                    {{-- <li><a href=""><i class="fa fa-pinterest"></i></a></li> --}}
                    <li><a href="https://www.instagram.com/waynaexp/ " target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>


    </footer>
    </div>
    <!-- /#wrapper -->
    <!-- MODAL -->
    <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body login_main_wrapper">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 register">
                            {{  Form::open(array('route' => 'post_register', 'class' => 'registration-form fomrm_left')) }}
                            <p>{{ trans('text.still_not_register') }}<br/>
                                {{ trans('text.please') }}, <span>{{ trans('text.register') }}.</span></p>
                            <div class="user_title"><strong>{{ trans('text.user') }}</strong></div>
                            <div class="form-group">
                                <label class="sr-only" for="username">{{ trans('text.username') }}</label>
                                <input type="text" name="username" placeholder="{{ trans('text.username') }}..." class="form-username form-control" id="form-username">
                                {{ $errors->first('username') }}
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="email">{{ trans('text.email') }}</label>
                                <input type="text" name="email" placeholder="{{ trans('text.email') }}..." class="form-email form-control" id="form-email">
                                {{ $errors->first('email') }}
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="email1">{{ trans('text.confirm_email') }}</label>
                                <input type="text" name="email1" placeholder="{{ trans('text.confirm_email') }}..." class="form-email1 form-control" id="form-email1">
                                {{ $errors->first('email1') }}
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">{{ trans('text.password') }}</label>
                                <input type="password" name="pass" placeholder="{{ trans('text.password') }}..." class="form-password form-control" id="form-password">
                                {{ $errors->first('pass') }}
                            </div>

                            <input type="hidden" name="last_name" style="display:none;" >
                            <input type="hidden" name="first_name" style="display:none;" >
                            <div class="form-group">
                                {{ Form::captcha(array('lang' => LaravelLocalization::getCurrentLocale())) }}
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-success">{{ trans('text.register') }}</button></div>
                            <p>{{ trans('text.confirm_text') }}</p>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-6 col-sm-12 login">
                            {{  Form::open(array('route' => 'post_login', 'class' => 'registration-form')) }}
                            <p>{{ trans('text.please') }}, <span>{{ trans('text.login_btn_text') }}.</span></p>
                            <div class="user_title"><strong>{{ trans('text.user') }}</strong></div>

                            <div class="form-group">
                                <label class="sr-only" for="login-email">{{ trans('text.email') }}</label>
                                <input type="text" name="login-email" placeholder="{{ trans('text.email') }}..." class="email form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="login-password">{{ trans('text.password') }}</label>
                                <input type="password" name="login-password" placeholder="{{ trans('text.password') }}..." class="password form-control" id="password">
                            </div>
                            <p class="no_marr">{{ trans('text.forget_password') }}</p>
                            <div class="text-center"><button type="submit" class="btn btn-success">{{ trans('text.login_btn_text') }}</button></div>

                            <div class="login_socail">
                                <a class="login_facebook" href="{{ URL::to('facebook/authorize') }}"><img src="{{ asset('images/login_facebook.png') }}" alt="" /></a>
                                <a class="login_facebook" href="{{ URL::to('google/authorize') }}"><img src="{{ asset('images/login_google+.png') }}" alt="" /></a>
                            </div>


                            {{ Form::close() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    {{-- Activation --}}
    <div class="modal fade" id="modal-activation" tabindex="-1" role="dialog" aria-labelledby="modal-activation-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 activation">
                            <p>{{ trans('text.almost_there') }}...</p>
                            <p>{{ trans('text.check_email') }}<br/>{{ trans('text.confirm_link') }}
                            </p>
                            <div class="text-center"><img class="sucess_msg_img" src="{{ asset('images/message.png') }}" alt="" /></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    {{--<script src="{{ asset('js/jquery.js') }}"></script>--}}
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
    <script src="//1000hz.github.io/bootstrap-validator/dist/validator.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>




    <!-- Menu Toggle Script -->


    <script type="text/javascript">
        // On document ready:

        $(function(){

            // Instantiate MixItUp:

            $('.categoryy').mixItUp();
        });

        $(function() {

            $(".search").keyup(function()
            {
                var searchid = $(this).val();
                var dataString = 'q=' + searchid;
                var URL = '{{ route("autosearch") }}';
                if (searchid != '')
                {
                    $.ajax({
                        type: "POST",
                        url: URL,
                        data: dataString,
                        cache: false,
                        success: function(html)
                        {
                            $("#result").html(html).show();
                        }
                    });
                }
                return false;
            });
        });

        function updateQty(new_qty, ex_qty, total_qty, product_type, pid, loc) {
            var request_url = '{{ route("updatecart") }}';
            jQuery.ajax({
                'url': request_url,
                'action': 'POST',
                'data': {
                    new_qty: new_qty,
                    ex_qty: ex_qty,
                    total_qty: total_qty,
                    product_type: product_type,
                    pid: pid,
                    loc: loc
                },
                'success': function(result) {
                    location.reload();
                },
                'error': function() {
                    console.log('Some error occurred');
                }
            });
        }

        function removeRow(row_id) {
            var request_url = '{{ route("remove_row") }}';
            jQuery.ajax({
                'url': request_url,
                'action': 'POST',
                'data': {
                    row_id: row_id
                },
                'success': function(result) {
                    //jQuery('ul.dropdown-cart').html(result.html);
                    //jQuery('li.cart .circle').html(result.count);
                    location.reload();
                },
                'error': function() {
                    console.log('Some error occurred');
                }
            });
        }

        // Get Location Data
        function getLocData(id) {
            var loc_id = id;
            if (id == '') {
                $('select#mail-price').val(0).find("option[value= 0]").attr('selected', true);
                $('select#gift-price').val(0).find("option[value= 0]").attr('selected', true);
                $('select#pdf-price, select#mail-price, select#gift-price').attr('disabled', 'disabled');
                //$('.payment_wrapper button.cart-btn').attr('disabled', 'disabled');
                //$('.payment_wrapper button.wishlist-btn').attr('disabled', 'disabled');
                //$('.payment_wrapper button.checkout-btn').attr('disabled', 'disabled');
                $('.payment_wrapper .row.count_loc div.bootstrap-select').addClass('disabled');
                $('.payment_wrapper .row.count_loc div.bootstrap-select button').addClass('disabled');
                $('#modal-lead-form #loc_idd').val('');

            } else {
                var request_url = '{{ route("getlocdata") }}';
                jQuery.ajax({
                    'url': request_url,
                    'action': 'POST',
                    'data': {
                        id: loc_id
                    },
                    'success': function(result) {
                        var details = result.details;
                        var priceHTML = result.priceHTML;
                        var price1 = result.price1;
                        var price2 = result.price2;
                        var price3 = result.price3;
                        var pdf_count = $('#pdf-price').val();
                        var mail_count = $('#mail-price').val();
                        var gift_count = $('#gift-price').val();
                        var total_price;
                        total_price = (pdf_count * price1) + (mail_count * price2) + (gift_count * price3);

                        var total_count = parseInt(pdf_count) + parseInt(mail_count) + parseInt(gift_count);
                        $("form#product-add input#total_qty").val(total_count);
                        $("form#product-add input#total_price").val(parseFloat(total_price).toFixed(2));
                        $("select#pdf-price, select#mail-price, select#gift-price").removeAttr('disabled');
                        $('.payment_wrapper .row.count_loc div.bootstrap-select').removeClass('disabled');
                        $('.payment_wrapper .row.count_loc div.bootstrap-select button').removeClass('disabled');
                        //$('.payment_wrapper button.cart-btn').removeAttr('disabled');
                        // $('.payment_wrapper button.wishlist-btn').removeAttr('disabled');
                        $('.payment_wrapper button.checkout-btn').removeAttr('disabled');
                        $("select#pdf-price").siblings('em').html('S/. <span>' + price1 + '</span>');
                        $("select#mail-price").siblings('em').html('S/. <span>' + price2 + '</span>');
                        $("select#gift-price").siblings('em').html('S/. <span>' + price3 + '</span>');
                        $('div#collapseOne .col-md-8').html(details);

                        $('h2.pricet').html('<span>Precio: S/.</span>' + parseFloat(total_price).toFixed(2));
                        $('#modal-lead-form #loc_idd').val(loc_id);
                    },
                    'error': function() {
                        console.log('Some error occurred');
                    }
                });
            }
        }
    </script>
    @if(isset($first_loc))
        <script type="text/javascript">
            $(function(){
                $('#basic').val('{{ $first_loc->id }}').trigger('change');
                $('#basic').change();
            });
        </script>
    @endif
    <?php //print_r(count($locations)); die();?>
    @if(isset($locations) && count($locations) ==1 && !isset($first_loc))
    <script type="text/javascript">
        $(function(){

            $('#basic').val('{{ $locations[0]->id }}').trigger('change');
            $('#basic').change();
        });
    </script>
    @endif


    @if(Input::has('error'))
    <script type="text/javascript">
        $(document).ready(function(){
            $( '#modal-register').modal();
        });
    </script>
    @endif
    @if(Auth::check())
    @if ( Auth::user()->first_name == '' || Auth::user()->last_name == '' || Auth::user()->direction == '' || Auth::user()->district == '' || Auth::user()->city == '' || Auth::user()->phone == '')    <script type="text/javascript">
        $(document).ready(function(){
            $( '#modal-register-checkout').modal();
        });
    </script>
    @endif
    @endif
    @if(Input::has('activation'))
    <script type="text/javascript">
        $(document).ready(function(){
            $( '#modal-activation').modal();
        });
    </script>
    @endif
    @yield('footer_script')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-75070327-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- solo popup-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    </body>
    </html>
@stop
