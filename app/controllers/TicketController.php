<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/16/16
 * Time: 2:08 PM
 */
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{

    /**
     * @param $order_id
     * @return mixed
     */
    public function create($order_id)
    {

//        return $pdf->download('invoice.pdf');
        $ticket=Input::get('ticket');
        #$ticketNumber=Input::get('ticketNumber');

        $order_items= OrderItems::where('order_id',$order_id)->get();

        //

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

            $this->generate_ticket_view($data);
            #return View::make('admin/ticket/ticket',$data);

        }

    }


    public function html_to_jpg(){
        $bg_path = public_path()."/pdf/ticket_bg.png";
        $options = [
            'width' => 500,
            'height' => 300,
            'quality' => 90
        ];

        $conv = new \Anam\PhantomMagick\Converter();
        $conv->addPage('
                    <html>
                        <body style="background-image: url('.$bg_path.'); background-repeat: no-repeat;">
                            <h1 style="color: red;">Welcome to PhantomMagick</h1>
                        </body>
                    </html>
                    ')
            ->setImageOptions($options)
            ->toJpg()
            ->save(public_path().'/pdf/22.jpg');

        return "OK";
    }
    public function ticket_html($data){

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
<body>
    <section style="width: 100%; height:auto;">
        <div style="width: 866px; height:297px; padding: 30px; margin: auto; background: #e0e0e0; border-radius: 15px;">
            <div style="width: 866px; height: 297px; background: url("'. asset('assets/images/ticket3.3.png') .'") no-repeat left top; margin: auto;">
                <div style="float: left; width: 420px; height: 100%; border-radius: 15px !important;">
                    <div>
                        <div style="width:250px; max-width: 300px; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;">
                            <div style="display: block; font-size: 12px;">'. trans("text.name") .' : </div>
                            <div style="display: block; font-size: 20px;">Alfredo Moron </div>
                        </div>
                    </div>
                    <div>
                        <div style="width:auto; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;float: left !important;">
                            <div style="display: block; font-size: 12px;">'. trans("text.until") .' : </div>
                            <div style="display: block; font-size: 20px;">30 . 12 . 2016 </div>
                        </div>
                        <div style="width:auto; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px; margin-left: 10px;background: black !important;border-radius: 8px !important;float: left !important;">
                            <div style="display: block; font-size: 12px;">'. trans('text.for') .' : </div>
                            <div style="display: block; font-size: 20px;">1 <span class="size-12">'. trans('text.person') .'</span> </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <div>
                        <div style="width:350px; max-width: 400px; height: auto; margin-top: 20px; color: #fff; padding: 10px 20px;background: black !important;border-radius: 0 8px 8px 0 !important;">
                            <div style="display: block; font-size: 12px;">'. trans('text.operator') .' : </div>
                            <div style="display: block; font-size: 20px;">
                                <div style="display: inline-block !important;width: 48% !important;border-right: 1px solid #909090;padding-right:1% !important;">
                                    <div style="display: block !important;">Indoor Flying</div>
                                    <div style="display: block !important;font-size: 25px !important;">+51 453 3450</div>
                                    <div style="display: block !important;font-size: 12px !important;">indoorsanisidro@hotmail.com</div>
                                </div>
                                <div style="background: #909090; position: relative;display: inline-block !important;width: 48% !important;padding-left:1% !important;position: relative !important;">
                                    <div style="display: block !important;font-size: 16px !important;position:absolute; margin-top: -50px;">Av. Solar 273</div>
                                    <div style="display: block !important;font-size: 16px !important;position:absolute; margin-top: -30px;">San Isidro - Lima, Peru</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="float: left; width: 257px; height: 100%; border-radius: 15px !important;position: relative !important;">
                    <div style="border-radius: 8px !important;" style="width:90%; height:66%; background:#f7931d; vertical-align:middle; position:absolute; top:17%;">
                        <img src="'. asset('assets/images/ticket-box.png') .'" width="100%;">
                        <span style="width:74%; position: absolute; top: 70px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;">'. trans('text.dont_forget') .' :</span>
                        <span style="width:74%; position: absolute; top: 70px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;">'. trans('text.contact_your_operator') .'</span>
                        <span style="width:74%; position: absolute; top: 110px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;">'. trans('text.carry_your_ticket') .'</span>
                        <span style="width:74%; position: absolute; top: 150px; right: 0; font-size: 15px; display: block; text-align: left; background:#f7931d; padding: 8px 0; color:#fff;">'. trans('text.enjoy_every_moment') .'</span>
                    </div>

                </div>
                <div style="float: left; width: 187px; height: 100%; background:none; border-radius: 15px !important;position: relative !important;">
                    <img src="'. asset('assets/images/ticket-box-2.png') .'" width="99%;" class="round-1">
                    <div style="width: 50px; height: 96%; border: 0px solid #ff2233; position: absolute; top: 4px; left: 65px; background: white;"></div>
                    <div style="-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 110px; left: 0px; bottom: 56px; border: 0px solid; font-size: 15px; background: #fff; font-weight: bold;">
                        '. trans('text.code') .' :
                    </div>
                    <div style="-ms-transform: rotate(-90deg); -webkit-transform: rotate(-90deg); transform: rotate(-90deg); position: absolute; width: 280px; left: -50px; top: 125px; border: 0px solid; font-size: 50px; font-weight: bold; text-align: center">
                        jWeRHljl
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>
</html>

        ';
        file_put_contents(public_path('html.html'), $html);

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
    private static function sendEmail($order)
    {
        $data['order_items'] = DB::table('order_items')
            ->where('order_items.order_id', $order->id)
            ->get();
        $admin=User::select('email')->where('type','admin')->get();
        $emails=[];
        foreach ($admin as $item) {
            $emails[]=$item->email;
        }
        $client=User::find($order->user_id);
        $email_client=$client->email;
        $pathToFile=public_path('assets/tickets/'.$order->order_number.'.png');

        Mail::send('emails.ticket', [], function($message) use ($emails,$email_client,$pathToFile,$order)
        {
            $message->subject('Ticket for '.$order->order_number.' no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'Exploor');

            $message->to($email_client)->bcc($emails);
            $message->to($emails);

            $message->attach($pathToFile);
        });


        $pe= DB::table('order_items');
        $pe= $pe->select('order_items.ticket_number','users.email','products.*','locations.price1 as price');
        $pe= $pe->join('products','products.id','=','order_items.product_id','left');
        $pe= $pe->join('locations','locations.product_id','=','products.id','left');
        $pe= $pe->join('users','users.id','=','products.user_id','left');
        $pe= $pe->where('order_items.order_id',$order->id);
        $pe= $pe->get();
        foreach ($pe as $item) {
            $item= (array) $item;
            if($item['email'] != null) {
                Mail::send('emails.ticket', $item, function ($message) use ($item, $pathToFile, $order) {
                    $message->subject('Ticket for ' . $order->order_number . ' no of order from Exploor');
                    $message->from('devdhaka404@gmail.com', 'Exploor');
                    $message->to($item['email']);
                    $message->attach($pathToFile);
                });
            }
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