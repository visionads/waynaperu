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
//        dd($ticket);
        $order=Order::find($order_id);
        if(TicketController::generateImage($ticket,$order->order_number)==true)
        {
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
        $pathToFile=public_path('assets/tickets/'.$order->order_number.'.png');
//        dd($email_client);

        Mail::send('emails.ticket', [], function($message) use ($emails,$email_client,$pathToFile,$order)
        {
            $message->subject('Ticket for '.$order->order_number.' no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'Exploor');

            $message->to($email_client)->bcc($emails);
//            $message->to($emails);

            $message->attach($pathToFile);
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
                Mail::send('emails.ticket', $item, function ($message) use ($item, $pathToFile, $order) {
                    $message->subject('Ticket for ' . $order->order_number . ' no of order from Exploor');
                    $message->from('devdhaka404@gmail.com', 'Exploor');
                    $message->to($item['email']);
                    $message->attach($pathToFile);
                });
            }
        }
    }
}