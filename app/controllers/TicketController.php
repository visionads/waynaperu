<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/16/16
 * Time: 2:08 PM
 */
class TicketController extends Controller
{
    public static function create($order_id)
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



//        $data['order'] = Order::find($order_id);











        dd($order);
//        echo '<img src="'.asset('assets/tickets/'.$order->order_number.'.png').'">';


    }
    private static function generateImage($base64,$image_name)
    {
        $path=public_path('assets/tickets/');
        list($type, $base64) = explode(';', $base64);
        $base64= explode(',', $base64);
        $base64 = str_replace(' ', '+', $base64[1]);
//        dd($base64);
        $base64 = base64_decode($base64);
        file_put_contents($path.$image_name.'.png', $base64);
        return true;
    }
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
        $pathToFile1=public_path('assets/tickets/'.$order->order_number.'1.png');
        $pathToFile2=public_path('assets/tickets/'.$order->order_number.'2.png');
//        dd($email_client);

        Mail::send('emails.ticket', [], function($message) use ($emails,$email_client,$pathToFile1,$pathToFile2,$order)
        {
            $message->subject('Ticket for '.$order->order_number.' no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'Exploor');

            $message->to($email_client)->bcc($emails);
//            $message->to($emails);

            $message->attach($pathToFile1);
            $message->attach($pathToFile2);
        });


        $pe= DB::table('order_items');
        $pe= $pe->select('users.email','products.*','locations.price1 as price');
        $pe= $pe->join('products','products.id','=','order_items.product_id','left');
        $pe= $pe->join('locations','locations.product_id','=','products.id','left');
        $pe= $pe->join('users','users.id','=','products.user_id','left');
        $pe= $pe->where('order_items.order_id',$order->id);
        $pe= $pe->get();
        foreach ($pe as $item) {
            $item= (array) $item;
//                dd($item);
            if($item['email'] != null) {
                Mail::send('emails.ticket', $item, function ($message) use ($item, $pathToFile1,$pathToFile2, $order) {
                    $message->subject('Ticket for ' . $order->order_number . ' no of order from Exploor');
                    $message->from('devdhaka404@gmail.com', 'Exploor');
                    $message->to($item['email']);
                    $message->attach($pathToFile1);
                    $message->attach($pathToFile2);
                });
            }
        }
    }


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
}