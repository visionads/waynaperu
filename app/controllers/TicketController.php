<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/16/16
 * Time: 2:08 PM
 */
class TicketController extends Controller
{
    public function create($order_id)
    {
        $ticket=Input::get('ticket');
        if(empty($ticket))
        {
            $url=route('ticket',$order_id);
            return View::make('admin/ticket/index',['url'=>$url]);
        }
        $order=Order::with('relOrderItems')->where('id',$order_id)->first();
        TicketController::generateImage($ticket,$order->order_number);



//        $data['order'] = Order::find($order_id);
        $data['order_items'] = DB::table('order_items')
            ->where('order_items.order_id', $order_id)
            ->get();
        $admin=User::select('email')->where('type','admin')->get();
        $emails=[];
        foreach ($admin as $item) {
            $emails[]=$item->email;
        }
        $client=User::find($order->user_id);
        $email_client=$client->email;
        $pathToFile=public_path('assets/tickets/'.$order->order_number.'.png');
//        dd($pathToFile);

        Mail::send('emails.ticket', [], function($message) use ($emails,$email_client,$pathToFile,$order)
        {
            $message->subject('Ticket for '.$order->order_number.' no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'Exploor');

//            $message->to($email_client)->bcc($emails);
            $message->to($emails);

            $message->attach($pathToFile);
        });


//        $pe= DB::table('order_items');
//        $pe= $pe->select('users.email','products.*','locations.price1 as price');
//        $pe= $pe->join('products','products.id','=','order_items.product_id','left');
//        $pe= $pe->join('locations','locations.product_id','=','products.id','left');
//        $pe= $pe->join('users','users.id','=','products.user_id','left');
//        $pe= $pe->where('order_items.order_id',$order_id);
//        $pe= $pe->get();
//        foreach ($pe as $item) {
//            $item= (array) $item;
//            Mail::send('emails.ticket', $item, function($message) use ($item,$pathToFile,$order)
//            {
//                $message->subject('Ticket for '.$order->order_number.' no of order from Exploor');
//                $message->from('devdhaka404@gmail.com', 'Exploor');
//                $message->to($item['email']);
//                $message->attach($pathToFile);
//            });
//        }










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
}