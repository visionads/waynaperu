<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Details Email</title>
</head>

<body style="margin: 0; padding: 0;">
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

<div style="width: 100%; margin: auto;">
    <header style="width: 100%; height: 50px; background: #121528;">
{{--        <img src="{{ 'https://wayna.com.pe/images/bcpagente128.png' }}" style="height: 100%">--}}
        <img src="{{ $message->embed('assets/images/email-temp-08.png') }}" style="height: 100%">
    </header>
    <section>
        <div style="font-size: 30px; text-align: center; padding: 10px 0;">{{ trans('pi.thank_you') }} <span style="color: orange;">{{ $user_name }} !</span></div>
        <div style="padding: 10px 0;">{{ trans('pi.confirmation_number') }} : <span style="color: orange;">{{ $order->order_number }}</span></div>
        <div>
            <table style="width: 100%; border-bottom: 1px solid orange; border-left: 1px solid orange; margin-bottom: 15px;" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.activity') }}</th>
                    <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.location') }}</th>
                    <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.quantity') }}</th>
                    <th style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ trans('pi.price') }}</th>
                </tr>
                </thead>
                <tbody>
                <?php $x=1;
                $total=0;
                ?>
                @foreach($order_items as $order_item)
                <tr>
                    <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->title }}</td>
                    <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->city.', '.$order_item->district }}</td>
                    <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">{{ $order_item->mail_qty+$order_item->pdf_qty }}</td>
                    <td style="border-top: 1px solid orange; border-right: 1px solid orange; padding: 5px; text-align: center">S/.{{ $order_item->mail_price+$order_item->pdf_price }}</td>
                </tr>
                </tbody>
                <?php $total+= $order_item->mail_price+$order_item->pdf_price; ?>
                @endforeach
            </table>
        </div>
        <div style="width: 100%; height: 20px; background: orange;">&nbsp;</div>
        <div style="text-align: center;">
            {{--<div style="width: 19%; height: auto; display: inline-block;"><img src="{{ $message->embed('assets/images/email-temp-01.png') }}" width="100%"></div>--}}
            {{--<div style="width: 19%; height: auto; display: inline-block;"><img src="{{ $message->embed('assets/images/email-temp-02.png') }}" width="100%"></div>--}}
            {{--<div style="width: 19%; height: auto; display: inline-block;"><img src="{{ $message->embed('assets/images/email-temp-03.png') }}" width="100%"></div>--}}
            {{--<div style="width: 19%; height: auto; display: inline-block;"><img src="{{ $message->embed('assets/images/email-temp-04.png') }}" width="100%"></div>--}}
            {{--<div style="width: 19%; height: auto; display: inline-block;"><img src="{{ $message->embed('assets/images/email-temp-05.png') }}" width="100%"></div>--}}
            <table width="100%" style="font-family: Arial; margin-bottom: 20px;">
                <tr style="text-align: center" valign="top">
                    <td width="20%" valign="top">
                        <img src="{{ $message->embed('assets/images/email-temp-01.1.png') }}" width="100%">
                        <p style="font-size: 14px;">{{ trans('pi.bcp') }}</p>
                    </td>
                    <td width="20%" valign="top">
                        <img src="{{ $message->embed('assets/images/email-temp-02.1.png') }}" width="100%">
                        <p style="font-size: 14px;">{{ trans('pi.transfer') }}<span style="color:deeppink">{{ $total }}</span><br>{{ trans('pi.to') }} : <strong>193-2298769-0-86</strong> </p>
                    </td>
                    <td width="20%" valign="top">
                        <img src="{{ $message->embed('assets/images/email-temp-03.1.png') }}" width="100%">
                        <p style="font-size: 14px;">{{ trans('pi.email') }}<br><span style="color:dodgerblue;">pago@exploor.pe</span> </p>
                    </td>
                    <td width="20%" valign="top">
                        <img src="{{ $message->embed('assets/images/email-temp-04.1.png') }}" width="100%">
                        <p style="font-size: 14px;">{{ trans('pi.receive') }} </p>
                    </td>
                    <td width="20%" valign="top">
                        <img src="{{ $message->embed('assets/images/email-temp-05.1.png') }}" width="100%">
                        <p style="font-size: 14px;">{{ trans('pi.gift') }}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 100%; height: 20px; background: orange;">&nbsp;</div>
        <div style="width: 100%; height: 20px;">&nbsp;</div>
        <div style="font-size: 25px; text-align: center;">{{ trans('pi.question') }}</div>
        <div style="text-align: center;"><img src="{{ $message->embed('assets/images/email-temp-06.png') }}" height="100"></div>
        <div style="font-size: 20px !important; text-align: center;">
            {{ trans('pi.mail_to') }} <span style="color: #0f71ba;">info@exploor.pe</span> {{ trans('pi.as_possible') }}
        </div>
        <div style="width: 100%; height: 20px;">&nbsp;</div>
        <div style="text-align: center; font-size: 20px !important;">{{ trans('pi.contact_us') }} <img src="{{ $message->embed('assets/images/social-2.png') }}" alt="" height="20px" width="20px">/explore</div>
        <div style="text-align: center;">
            <table width="100%">
            <tr>
                <td style="text-align: center;">
                    <a href="#"><img src="{{ $message->embed('assets/images/social-1.png') }}" style="height: 4vw"></a>
                    <a href="#"><img src="{{ $message->embed('assets/images/social-2.png') }}" style="height: 4vw"></a>
                    <a href="#"><img src="{{ $message->embed('assets/images/social-3.png') }}" style="height: 4vw"></a>
                </td>
            </tr>
            </table>
        </div>
    </section>
    <footer style="text-align: center;width: 100%; height: auto; background: orange; padding: 10px 0;">
        <div>{{ trans('pi.translation') }} <span style="color: #0f71ba;">info@exploor.pe</span><br>{{ trans('pi.registered_on') }} <br> <span style="color: #0f71ba;">www.exploor.pe</span> {{ trans('pi.address') }}</div>
    </footer>
</div>

</body>
</html>