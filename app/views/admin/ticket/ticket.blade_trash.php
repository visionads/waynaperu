<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticket</title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">
    <!-- END META -->
    <script src="{{ asset('assets/admin/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
    <style>
        .ticket_parent { width: 100%; height:auto;}
        .ticket_wrap { width: 866px; height:297px; padding: 30px; margin: auto; background: #e0e0e0; border-radius: 15px;}
        .ticket { width: 866px; height: 297px; background: url("{{ asset('assets/images/ticket3.3.png') }}") no-repeat left top; margin: auto;}
        .ticket_left {float: left; width: 420px; height: 100%; border-radius: 15px !important;}
        .ticket_mid { float: left; width: 257px; height: 100%; border-radius: 15px !important;}
        .ticket_right {float: left; width: 187px; height: 100%; background:none; border-radius: 15px !important;}

        .clr { clear: both;}
        .left_img img { border-radius: 15px 0 0 15px !important;}
        .black-bg { background: black !important;}
        .round-right { border-radius: 0 8px 8px 0 !important;}
        .round { border-radius: 8px !important;}
        .round-1 { border-radius: 15px !important;}
        .block { display: block !important;}
        .inline-block { display: inline-block !important;}
        .w-48-prcnt { width: 48% !important;}
        .border-right { border-right: 1px solid #909090;}
        .padding-right { padding-right:1% !important; }
        .padding-left { padding-left:1% !important; }
        .relative { position: relative !important;}
        .pos-1 { position:absolute; margin-top: -50px;}
        .pos-2 { position:absolute; margin-top: -30px;}

        .float-left { float: left !important;}
        .name { width:250px; max-width: 300px; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;}
        .time { width:auto; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;}
        .for { width:auto; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px; margin-left: 10px;}
        .operator { width:350px; max-width: 400px; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;}

        div.label { display: block; font-size: 12px;}
        div.item { display: block; font-size: 20px;}
        .size-12 { font-size: 12px !important;}
        .size-16 { font-size: 16px !important;}
        .size-20 { font-size: 20px !important;}
        .size-25 { font-size: 25px !important;}

        .bg-1 {background: rgba(150,150,150,0.5);}
        .bg-2 {background: rgba(120,120,120,0.5);}
        .bg-3 {background: rgba(100,100,100,0.5);}

        .rotate { -ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg);}

        span.title-1 {width:100%; position: absolute; top: 30px; font-size: 25px; display: block; text-align: center; background:#f7931d; padding: 5px 0; color:#fff;}
        span.list-1 {width:74%; position: absolute; top: 70px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;}
        span.list-2 {width:74%; position: absolute; top: 110px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;}
        span.list-3 {width:74%; position: absolute; top: 150px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;}

        div.code_label {-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 110px; left: 0px; bottom: 56px; border: 0px solid; font-size: 15px; background: #fff; font-weight: bold;}
    </style>
</head>
<body>
<section class="ticket_parent" id="mydiv">
    <div class="ticket_wrap">
        <div class="ticket">
            <div class="ticket_left">
                <div>
                    <div class="name black-bg round-right">
                        <div class="label">{{ trans('text.name') }} : </div>
                        <div class="item">{{ $user->first_name.' '.$user->last_name }}</div>
                    </div>
                </div>
                <div>
                    <div class="time black-bg round-right float-left">
                        <div class="label">{{ trans('text.until') }} : </div>
                        <div class="item">{{ $validity }}</div>
                    </div>
                    <div class="for black-bg round float-left">
                        <div class="label">{{ trans('text.for') }} : </div>
                        <div class="item">{{ $order->qty }} <span class="size-12">{{ trans('text.person') }}</span> </div>
                    </div>
                    <div class="clr"></div>
                </div>
                <div>
                    <div class="operator black-bg round-right">
                        <div class="label">{{ trans('text.operator') }} : </div>
                        <div class="item">
                            <div class="inline-block w-48-prcnt border-right padding-right">
                                <div class="block">{{ $provider->first_name.' '.$provider->last_name }}</div>
                                <div class="block size-25">{{ $provider->phone }}</div>
                                <div class="block size-12">{{ $provider->email }}</div>
                            </div>
                            <div class="inline-block w-48-prcnt padding-left relative" style="background: #909090; position: relative">
                                <div class="block size-16 pos-1">{{ $provider->address }}</div>
                                <div class="block size-16 pos-2">{{ $provider->city }}, {{ $provider->province }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ticket_mid relative">
                <div class="round" style="width:90%; height: 66%; background: #f7931d; vertical-align: middle; position: absolute; top: 17%;">
                    {{--<div>No ovides / Don't Forget :</div>--}}
                    <img src="{{ asset('assets/images/ticket-box.png') }}" width="100%;">
                    <span class="title-1">{{ trans('text.dont_forget') }} :</span>
                    <span class="list-1">{{ trans('text.contact_your_operator') }}</span>
                    <span class="list-2">{{ trans('text.carry_your_ticket') }}</span>
                    <span class="list-3">{{ trans('text.enjoy_every_moment') }}</span>
                </div>
            </div>
            <div class="ticket_right relative">
                <img src="{{ asset('assets/images/ticket-box-2.png') }}" width="99%;" class="round-1">
                <div style="width: 50px; height: 96%; border: 0px solid #ff2233; position: absolute; top: 4px; left: 65px; background: white;"></div>
                <div class="code_label">
                    {{ trans('text.code') }} :
                </div>
                <div style="-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 280px; left: -50px; top: 125px; border: 0px solid; font-size: 50px; font-weight: bold; text-align: center">
                    {{ $ticketNumber }}
                </div>
            </div>
        </div>
    </div>

</section>
<br>
<br>

<div id="canvas">
    <p>Canvas:</p>
</div>

<div id="image">
    <p>Image:</p>
</div>
<input type="hidden" id="url" value="{{ $url }}">
<input type="hidden" id="ticketNumber" value="{{ $ticketNumber }}">
<script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>

<script>
    html2canvas([document.getElementById('mydiv')], {
        onrendered: function (canvas) {
            document.getElementById('canvas').appendChild(canvas);
            var data = canvas.toDataURL('image/png');
            // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server

            var theUrl = $('#url').val();
            var ticketNumber = $('#ticketNumber').val();
            var form = $('<form action="' + theUrl + '" method="post">' +
                    '<input type="text" name="ticket" value="' + data + '" />' +
                    '<input type="hidden" name="ticketNumber" value="' + ticketNumber + '" />' +
                    '</form>');
            $('body').append(form);
            form.submit();


//            window.location.href = theUrl + '?ticket='+data;
            var image = new Image();
            image.src = data;
            document.getElementById('image').appendChild(image);
        }
    });
</script>
</body>
</html>