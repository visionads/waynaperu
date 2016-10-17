<!DOCTYPE html>
<html lang="en">
<head>
    <title>Waynaperu Ticket</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->
    <style>
        .ticket_parent { width: 100%; height:auto;}
        .ticket_wrap { width: 866px; height:297px; padding: 30px; margin: auto; background: #e0e0e0; border-radius: 15px;}
        .ticket { width: 866px; height: 297px; background: url("{{ asset('assets/images/ticket3.3.png') }}") no-repeat left top; margin: auto;}
        .ticket_left {float: left; width: 500px; height: 100%; border-radius: 15px !important;}
        .ticket_mid { float: left; width: 2px; height: 100%; background: none;}
        .ticket_right {float: left; width: 198px; height: 100%; background:none; border-radius: 15px !important;}
        .clr { clear: both;}
        .left_img img { border-radius: 15px 0 0 15px !important;}
    </style>
</head>
<body>
    <section class="ticket_parent">
        <div class="ticket_wrap">
            <div class="ticket">
                <div class="ticket_left">
                    {{--<span class="left_img"><img src="{{ asset('assets/images/ticket3-bg-left-trans-1.png') }}"></span>--}}
                </div>
                <div class="ticket_mid"></div>
                <div class="ticket_right">

                </div>
            </div>
        </div>

    </section>
</body>
</html>
