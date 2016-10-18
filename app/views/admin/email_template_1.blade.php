
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
                <div class="title-1 center padding-10-0">Thank you <span class="orange">Alberto Rojas !</span></div>
                <div class=" padding-10-0">Confirmation number : <span class="orange">xhsdlkfjjfy08</span></div>
                <div>
                    <table class="tbl-1" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>Location</th>
                                <th>Quantity</th>
                                <th>Price</th>
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
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-01.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-02.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-03.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-04.png') }}" width="100%"></div>
                    <div class="box-1"><img src="{{ asset('assets/images/email-temp-05.png') }}" width="100%"></div>
                </div>
                <div class="orange-bar">&nbsp;</div>
                <div class="h-space">&nbsp;</div>
                <div class="title-2 center">Questions ?</div>
                <div class="center"><img src="{{ asset('assets/images/email-temp-06.png') }}" height="100"></div>
                <div class="size-20 center">
                    If you have any questions shoot us a mail to <span class="blue">info@exploor.pe</span> and<br> we will get in touch with you as soon as possible.
                </div>
                <div class="h-space">&nbsp;</div>
                <div class="center size-20">You can also contact us 24/7 f/explore</div>
                <div class="center"><img src="{{ asset('assets/images/email-temp-07.png') }}" height="90"></div>
            </section>
            <footer class="center">
                <div>If you have not made this transaction please contact us under <span class="blue">info@exploor.pe</span><br>You received this mail from exploor (Waynaperu S.A.C) because you registered on <br> <span class="blue">www.exploor.pe</span> with this email address.<br>Avenida Aviacion 4004 Districto de Surquillo, Lima, Peru.</div>
            </footer>
        </div>
