
        <style>
            body { margin: 0; padding: 0;}
            .main { width: 50%; margin: auto}
            header { width: 100%; height: 50px; background: #121528; }
            footer { width: 100%; height: auto; background: orange; padding: 10px 0;}
            .title-1 { font-size: 30px; }
            .title-2 { font-size: 25px; }
            .blue { color: #0f71ba;}
            .orange {color: orange}
            .orange-bg {background: orange}
            .center { text-align: center}
            .padding-10-0{ padding: 10px 0;}
            .tbl-1 { width: 100%; border-bottom: 1px solid orange; border-left: 1px solid orange; margin-bottom: 15px;}
            .tbl-1 th, .tbl-1 td { border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center}
            .orange-bar { width: 100%; height: 20px; background: orange}
            .box-1 { width: 19%; height: auto; display: inline-block;}
            .h-space { width: 100%; height: 20px;}
            .size-20 { font-size: 20px !important; }
        </style>

        <div class="main">
            <header>
                <img src="{{ asset('assets/images/email-temp-08.png') }}" style="height: 100%">
            </header>
            <section>
                <div class="title-1 center padding-10-0">{{ trans('provider.thank_you') }} <span class="orange">Alberto Rojas !</span></div>
                <div class=" padding-10-0">{{ trans('provider.confirmation_number') }} : <span class="orange">xhsdlkfjjfy08</span></div>
                <div>
                    <table class="tbl-1" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ trans('provider.activity') }}</th>
                                <th>{{ trans('provider.location') }}</th>
                                <th>{{ trans('provider.quantity') }}</th>
                                <th>{{ trans('provider.price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Activity-01</td>
                                <td>Location</td>
                                <td>12</td>
                                <td>S/. 210.00</td>
                            </tr>
                            <tr>
                                <td>Activity-02</td>
                                <td>Location</td>
                                <td>23</td>
                                <td>S/. 140.00</td>
                            </tr>
                            <tr>
                                <td>Activity-03</td>
                                <td>Location</td>
                                <td>20</td>
                                <td>S/. 240.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="orange-bar">&nbsp;</div>
                <div class="center">
                    {{--<div class="box-1"><img src="{{ asset('assets/images/email-temp-01.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-02.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-03.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-04.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-05.png') }}" width="100%"></div>--}}
                    <table width="100%" style="font-family: Arial; margin-bottom: 20px;">
                        <tr style="text-align: center">
                            <td width="20%">
                                <img src="{{ asset('assets/images/email-temp-01.1.png') }}" width="100%">
                                <p style="font-size: 14px;">Please visit an agency<br> or actual BPC bank<br> counter</p>
                            </td>
                            <td width="20%">
                                <img src="{{ asset('assets/images/email-temp-02.1.png') }}" width="100%">
                                <p style="font-size: 14px;">Transfer the <br> Amount of S/.<span style="color:deeppink">XX.XX</span><br>to : <strong>193-2298769-0-86</strong> </p>
                            </td>
                            <td width="20%">
                                <img src="{{ asset('assets/images/email-temp-03.1.png') }}" width="100%">
                                <p style="font-size: 14px;">Send a photo<br>of the voucher to<br><span style="color:dodgerblue;">pago@exploor.pe</span> </p>
                            </td>
                            <td width="20%">
                                <img src="{{ asset('assets/images/email-temp-04.1.png') }}" width="100%">
                                <p style="font-size: 14px;">Receive your<br>Ticket </p>
                            </td>
                            <td width="20%">
                                <img src="{{ asset('assets/images/email-temp-05.1.png') }}" width="100%">
                                <p style="font-size: 14px;">Enjoy the moment or give an unforgettable gift to someone else</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="orange-bar">&nbsp;</div>
                <div class="h-space">&nbsp;</div>
                <div class="title-2 center">{{ trans('provider.Questions') }} ?</div>
                <div class="center"><img src="{{ asset('assets/images/email-temp-06.png') }}" height="100"></div>
                <div class="size-20 center">
                    {{ trans('provider.If_have_q') }} <span class="blue">info@exploor.pe</span> and<br> {{ trans('provider.we_will_get') }}.
                </div>
                <div class="h-space">&nbsp;</div>
                <div class="center size-20">{{ trans('provider.you_can_also') }} 24/7 f/explore</div>
                <div class="center">
                    <table width="100%">
                        <tr>
                            <td style="text-align: center;">
                                <a href="#"><img src="{{ asset('assets/images/social-1.png') }}" style="height: 4vw"></a>
                                <a href="#"><img src="{{ asset('assets/images/social-2.png') }}" style="height: 4vw"></a>
                                <a href="#"><img src="{{ asset('assets/images/social-3.png') }}" style="height: 4vw"></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </section>
            <footer class="center">
                <div>{{ trans('provider.if_you_have_not') }} <span class="blue">info@exploor.pe</span><br>{{ trans('provider.you_received') }} <br> <span class="blue">www.exploor.pe</span> {{ trans('provider.with_this') }}.<br>Avenida Aviacion 4004 Districto de Surquillo, Lima, Peru.</div>
            </footer>
        </div>
