<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/16/16
 * Time: 2:08 PM
 */
use Illuminate\Support\Facades\DB;
use Anam\PhantomMagick\Converter;


class TicketController extends Controller
{
    /**
     * @param $order_id
     * @return mixed
     */
    public static function create($order_id,$ipn=false)
    {

        $ticket=Input::get('ticket');
        #$ticketNumber=Input::get('ticketNumber');

        $order_items= OrderItems::where('order_id',$order_id)->get();

        foreach($order_items as $items)
        {
            $data['ticket_number']=TicketController::generateTicketNumber();
            // client info
            $order = DB::table('orders')->where('id', $order_id)->first();
            $data['order']= $order;
            $client_id = $order->user_id;
            $data['client_info'] = User::where('id', $client_id)->first();

            //Join Query
            $data['product_info'] = DB::table('products')
                ->select('product_content.title', 'product_info.validity')
                ->join('product_info', 'product_info.product_id', '=', 'products.id')
                ->join('product_content', 'product_content.product_id', '=', 'products.id')
                ->where('products.id', $items['product_id'])
                ->first();

            //Provider + Location ID
            $data['provider'] = DB::table('products')
                ->select('users.id', 'users.first_name','users.last_name','users.phone','users.email','users.address','users.city','users.province')
                ->join('users','users.id','=','products.user_id','left')
                ->where('products.id',$items['product_id'])
                ->first();

            //url for redirecting to this method again according to order id
            $data['url']= route('generate-ticket',$order_id);

            $x= DB::select(DB::raw("
                    SELECT
                      order_items.id as order_item_id,
                      order_items.order_id,
                      users.first_name,
                      users.last_name,
                      users.type,
                      users1.first_name as provider_first_name,
                      users1.last_name as provider_last_name,
                      users1.email as provider_email,
                      users1.phone as provider_phone,
                      product_info.validity,
                      product_info.city,
                      product_info.street,
                      product_info.district,
                      product_content.title,
                      orders.qty
                    FROM order_items
                      LEFT JOIN product_content ON product_content.product_id=order_items.product_id
                      LEFT JOIN product_info ON product_info.product_id=order_items.product_id
                      LEFT JOIN orders ON orders.id=order_items.order_id
                      LEFT JOIN products ON products.id=order_items.product_id
                      LEFT JOIN users ON users.id=orders.user_id
                      LEFT JOIN users as users1 ON users1.id=products.user_id
                    WHERE order_id=453
                    GROUP BY order_items.id"));
            $data['tickets']=$x;

            foreach ($data['tickets'] as $ticket)
            {

//                TicketController::html_to_jpg($ticket);
                
                #dd($ticket);
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $ticket->type='provider';
                $ticket->ticket_number=$randomString;

                TicketController::html_to_jpg($ticket);

                $ticket->type='client';
                $ticket->ticket_number=$randomString;
                TicketController::html_to_jpg($ticket);
                $t= new Ticket();
                $t->ticket_number= $ticket->ticket_number;
                $t->order_item_id= $ticket->order_item_id;
                $t->order_id= $ticket->order_id;
                $t->save();
                TicketController::emailProvider($ticket->order_item_id);
            }
            TicketController::sendEmail($order_id);
            $o=Order::find($order_id);
            $o->status='SUCCESS';
            #$o->save();
            #dd($order);
            if(isset($ipn) && !empty($ipn))
            {
                return true;
            }else{
                Session::flash('message','Ticket has been sent successfully.');
                return Redirect::to('admin/orders');
            }
        }

    }

    public static function html_to_jpg($ticket)
    {

        $bg_path = public_path()."/tickets/ticket_bg.jpg";
        $options = [
            'width' => 500,
            'height' => 300,
            'quality' => 90
        ];

        $conv = new  \Anam\PhantomMagick\Converter();

        if($ticket->type=='provider')
        {
            $tnm= $ticket->ticket_number;
            $ticket->ticket_number= substr($ticket->ticket_number,0,-4).'****';
            $conv->addPage(TicketController::ticket_html($ticket))
                ->setImageOptions($options)
                ->toJpg()
                ->save(public_path().'/assets/tickets/P-'.$tnm.'.jpg');

            print_r($conv);
            exit();
        }else{
            $conv->addPage(TicketController::ticket_html($ticket))
                ->setImageOptions($options)
                ->toJpg()
                ->save(public_path().'/assets/tickets/'.$ticket->ticket_number.'.jpg');
        }
    }
    public static function ticket_html($ticket)
    {
        $first_name = $ticket->first_name ? $ticket->first_name:null;
        $last_name = $ticket->last_name ? $ticket->last_name:'';
        $validity = $ticket->validity ? $ticket->validity:'';
        $qty = $ticket->qty ? $ticket->qty:'';
        $provider_first_name = $ticket->provider_first_name ? $ticket->provider_first_name:'';
        $provider_last_name = $ticket->provider_last_name ? $ticket->provider_last_name:'';
        $provider_phone = $ticket->provider_phone ? $ticket->provider_phone:'';
        $provider_email = $ticket->provider_email ? $ticket->provider_email:'';
        $street = $ticket->street ? $ticket->street:'';
        $city = $ticket->city ? $ticket->city:'';
        $district = $ticket->district ? $ticket->district:'';
        $ticket_title = $ticket->title ? $ticket->title:'';
        $ticket_number = $ticket->ticket_number ? $ticket->ticket_number:'';

        $urll = asset("assets/images/ticket3.3.png");

        //print_r($urll);exit();
        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
            <title>Waynaperu Ticket</title>
            
            <!-- BEGIN META -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="keywords" content="your,keywords">
            <meta name="description" content="Short explanation about this website">
            <!-- END META -->
            </head>
            <body style="background-color: white;">
            <section style="width: 100%; height:auto;">
                <div style="width: 866px; height:297px; padding: 30px; margin: auto; background: #e0e0e0; border-radius: 15px;">
                    <div style="width: 866px; height: 297px; background: url('.$urll.') no-repeat left top; margin: auto;">
                        <div style="float: left; width: 420px; height: 100%; border-radius: 15px !important;">
                            <div>
                                <div style="width:250px; max-width: 300px; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;">
                                    <div style="display: block; font-size: 12px;">Nombre / Name : </div>
                                    <div style="display: block; font-size: 20px;">'.$first_name.' '.$last_name.'</div>
                                </div>
                            </div>
                            <div>
                                <div style="width:auto; height: auto; margin-top: 15px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;float: left !important;">
                                    <div style="display: block; font-size: 12px;">Vigente hasta/ Valid Until : </div>
                                    <div style="display: block; font-size: 20px;">'. date("d.m.Y",strtotime("+".$validity." months")) .'</div>
                                </div>
                                <div style="width:auto; height: auto; margin-top: 15px; color: #fff; padding: 10px 20px; margin-left: 10px;background: black !important;border-radius: 8px !important;float: left !important;">
                                    <div style="display: block; font-size: 12px;">Para/ For : </div>
                                    <div style="display: block; font-size: 20px;">'.$qty.' <span style="font-size:12px;">Persona/Person</span> </div>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <div>
                                <div style="width:350px; max-width: 400px; height: auto; margin-top: 15px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;">

                                    <table>
                                        <tr><td style="font-size:12px;">Operador/ Operator :</td></tr>
                                        <tr>
                                            <td style=" padding-right:10px;">
                                                <span style="font-size: 15px">'.$provider_first_name.' '.$provider_last_name.'</span><br>
                                                <span style="font-size:20px;">'.$provider_phone.'</span><br>
                                                <span style="font-size:12px;">'.$provider_email.'</span><br>
                                            </td>
                                            <td style="border-left:1px solid #fff; padding-left:10px;">
                                                <span style="font-size:16px;">'.$street.'</span><br>
                                                <span style="font-size:16px;">'.$city.'</span><br>
                                                <span style="font-size:16px;">'.$district.'</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; width: 257px; height: 100%; position: relative !important;">
                            <div style="height:66%; background:none; vertical-align:middle; position:absolute; top:12%; border:0px solid;">
                                <img src="'. asset('assets/images/ticket-box.png') .'" width="80%;" style="padding-left: 20px;">
                                <span style="width:74%; position: absolute; top: 55px; right: -10px; font-size: 12px; display: block; text-align: left; background:none; padding: 8px 0; color:#fff;">'. trans('text.contact_your_operator') .'</span>
                                <span style="width:74%; position: absolute; top: 92px; right:-10px; font-size: 12px; display: block; text-align: left; background:none; padding: 8px  0;  color:#fff;">'. trans('text.carry_your_ticket') .'</span>
                                <span style="width:74%; position: absolute; top: 130px; right: -10px; font-size: 12px; display: block; text-align: left; background:none; padding: 8px  0; color:#fff;">'. trans('text.enjoy_every_moment') .'</span>
                            </div>
                            <div style="border-radius: 8px !important; width:80%; height:10%; vertical-align:middle; position:absolute; top:80%; text-align:center; padding-left: 20px;border: 0px solid;">'.$ticket_title.'</div>
                        </div>
                        <div style="float: left; width: 187px; height: 100%; background:none; border-radius: 15px !important;position: relative !important;">
                            <img src="'. asset('assets/images/ticket-box-2.png') .'" width="99%;" style="padding-left:2px; border-radius:15px;">
                            <div style="width: 50px; height: 96%; border: 0px solid #ff2233; position: absolute; top: 4px; left: 65px; background: white;"></div>
                            <div style="-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 110px; left: 0px; bottom: 56px; border: 0px solid; font-size: 15px; background: #fff; font-weight: bold;">
                                '. trans('text.code') .' :
                            </div>
                            <div style="-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 280px; left: -50px; top: 125px; border: 0px solid; font-size: 35px; font-weight: bold; text-align: center">
                                '.$ticket_number.'
                            </div>
                        </div>
                    </div>
                </div>
            
            </section>
            </body>
            </html>
        ';

        return $html;

    }

    /**
     * @param $data
     * @return bool
     */
    public function generate_ticket_view($data)
    {

        $ticket=Input::get('ticket');
        $ticket2=Input::get('ticket2');
        $ticketNumber=Input::get('ticketNumber');
        $order=Order::find($order_id);
        if(empty($ticketNumber)){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $ticketNumber=$randomString;

        }
        if(empty($ticket))
        {
            $order_items= OrderItems::where('order_id',$order_id)->first();
            $data['order']= $order;
            $product_info= ProductInfo::select('validity')->where('product_id',$order_items->product_id)->where('language_id',1)->first();
            $m= (int) $product_info->validity;
            $data['validity']=date('d M Y', strtotime('+'.$m.' months'));
//            $data['product_content']= ProductContent::select('title')->where('product_id',$order_items->product_id)->where('lang_id',1)->first();
            $data['user']=User::select('first_name','first_name')->where('id',$order->user_id)->first();
            $data['provider']= DB::table('products')
                ->select('users.*')
                ->join('users','users.id','=','products.user_id','left')
                ->where('products.id',$order_items->product_id)
                ->first();
            $data['ticketNumber']=$ticketNumber;
            $data['url']=route('ticket',$order_id);
            return View::make('admin/ticket/ticket',$data);
        }elseif(empty($ticket2))
        {
            TicketController::generateImage($ticket,$order->order_number.'1');
            $order_items= OrderItems::where('order_id',$order_id)->first();
            $data['order']= $order;
            $product_info= ProductInfo::select('validity')->where('product_id',$order_items->product_id)->where('language_id',1)->first();
            $m= (int) $product_info->validity;
            $data['validity']=date('d M Y', strtotime('+'.$m.' months'));
//            $data['product_content']= ProductContent::select('title')->where('product_id',$order_items->product_id)->where('lang_id',1)->first();
            $data['user']=User::select('first_name','first_name')->where('id',$order->user_id)->first();
            $data['provider']= DB::table('products')
                ->select('users.*')
                ->join('users','users.id','=','products.user_id','left')
                ->where('products.id',$order_items->product_id)
                ->first();
            $data['ticketNumber']=$ticketNumber;
            $data['url']=route('ticket',$order_id);
            return View::make('admin/ticket/ticket2',$data);
        }
        if(TicketController::generateImage($ticket2,$order->order_number.'2')==true)
        {
            $tkt=new Ticket();
            $tkt->order_id=$order->id;
            $tkt->ticket_number=$ticketNumber;
            $tkt->save();

            TicketController::sendEmail($order);
            $order->status='SUCCESS';
            $order->save();
            Session::flash('message','Ticket has been sent successfully.');
            return Redirect::to('admin/orders');
        }else{

            Session::flash('error','Sorry, Something went wrong ! please try again later.');
            return Redirect::to('admin/orders');
        }

    }

    /**  Make image and store into a directory
     * @param $base64
     * @param $image_name
     * @param $order_id
     * @return bool
     */
    private static function generateImage($base64, $image_name, $order_id)
    {
        exit("generateImage");
        $path = public_path('assets/tickets/'.$order_id.'/');
        list($type, $base64) = explode(';', $base64);
        $base64= explode(',', $base64);
        $base64 = str_replace(' ', '+', $base64[1]);
        $base64 = base64_decode($base64);

        exit($type);

        // Keep the image into directory
        file_put_contents($path.$image_name.'.png', $base64);
        return true;
    }

    /**
     * @param $order
     */
    private static function sendEmail($order_id)
    {
        $tickets= Ticket::where('order_id',$order_id)->get();
//        dd($tickets);
        $admin = User::select('email')->where('type','admin')->get();
        $emails = [];
        foreach ($admin as $item) {
            $emails[]=$item->email;
        }
        $client = DB::table('orders')
            ->select('users.email')
            ->join('users','users.id','=','orders.user_id','left')
            ->where('orders.id','=',$order_id)
            ->first();
        $email_client=$client->email;
        $pathToFile=[];
        foreach ($tickets as $ticket) {
            $pathToFile[]=public_path('assets/tickets/'.$ticket->ticket_number.'.jpg');
        }
        Mail::send('emails.ticket', [], function($message) use ($emails,$email_client,$pathToFile)
        {
            $message->subject('Ticket for  no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'exploor.pe');

            $message->to($email_client)->bcc($emails);
            $message->to($emails);
            foreach ($pathToFile as $item) {
                $message->attach($item);
            }
        });

    }
    public static function emailProvider($order_item_id)
    {
        $pe= DB::table('order_items');
        $pe= $pe->select('ticket.ticket_number','users.email');
        $pe= $pe->join('products','products.id','=','order_items.product_id','left');
        $pe= $pe->join('users','users.id','=','products.user_id','left');
        $pe= $pe->join('ticket','ticket.order_item_id','=','order_items.id','left');
        $pe= $pe->where('order_items.id',$order_item_id);
        $pe= $pe->first();

        $item= (array) $pe;
        if($item['email'] != null) {
            $pathToFile=public_path('assets/tickets/P-'.$item["ticket_number"].'.jpg');
            Mail::send('emails.ticket', $item, function ($message) use ($item, $pathToFile) {
                $message->subject('Ticket for new sale.');
                $message->from('devdhaka404@gmail.com', 'exploor.pe');
                $message->to($item['email']);
                $message->attach($pathToFile);
            });
        }
    }


    /**
     * @return mixed
     */
    public function check_ticket()
    {
        $input= Input::all();
        $ticket=Ticket::where('order_id',$input['order_id'])->where('ticket_number',$input['ticket_number'])->first();
        if(isset($ticket) && count($ticket)>0)
        {
            $order_item=OrderItems::find($input['order_item_id']);
            $order_item->status='used';
            $order_item->save();
            Session::flash('message','Ticket has been activated.');
            return Redirect::to('admin/order/'.$input['order_id']);
        }else{
            Session::flash('error','Invalid ticket number');
            return Redirect::to('admin/order/'.$input['order_id']);
        }
    }


    /**
     * @return string
     */
    private static function generateTicketNumber()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $ticketNumber=$randomString;
    }


}