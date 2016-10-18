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

            $this->generate_ticket_view($data);
            #return View::make('admin/ticket/ticket',$data);

            exit();
        }

    }

    /**
     * @param $data
     * @return bool
     */
    public function generate_ticket_view($data)
    {
        /*ini_set("memory_limit","256M");
        $filename = public_path('assets/images/ticket.jpg');

        $img = @imagecreatefromjpeg($filename);
        $exif = exif_read_data($filename);
        if ($img && $exif && isset($exif['Orientation']))
        {
            $ort = $exif['Orientation'];

            if ($ort == 6 || $ort == 5)
                $img = imagerotate($img, 270, null);
            if ($ort == 3 || $ort == 4)
                $img = imagerotate($img, 180, null);
            if ($ort == 8 || $ort == 7)
                $img = imagerotate($img, 90, null);

            if ($ort == 5 || $ort == 4 || $ort == 7)
                imageflip($img, IMG_FLIP_HORIZONTAL);
        }
        print_r($img);

        exit();
        $my_img = imagecreate( 200, 80 );
        $background = imagecolorallocate( $my_img, 0, 0, 255 );
        $text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
        $line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
        imagestring( $my_img, 4, 30, 25, "Ram Vai", $text_colour );
        imagesetthickness ( $my_img, 5 );
        imageline( $my_img, 30, 45, 165, 45, $line_colour );

        header( "Content-type: image/png" );
        imagepng( $my_img );
        imagecolordeallocate( $line_colour );
        imagecolordeallocate( $text_colour );
        imagecolordeallocate( $background );
        imagedestroy( $my_img );

        echo "0000";
        exit();
        $ticket = Input::get('ticket');
        if(empty($ticket))
        {
            echo "empty";
            return "554545454545454542";
        }
        else
        {
            $order_number = $data['order']->order_number;
            $provider_id = $data['provider']->id;
            $order_id = $data['order']->id;
            TicketController::generateImage($ticket, $order_number.'-'.$provider_id, $order_id);
        }
        exit("qwq");
        return true;*/
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
            //$message->attach($pathToFile2);
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