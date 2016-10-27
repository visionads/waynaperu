<?php
class OrdersController extends BaseController {
	public function __construct()
    {
        $lang_code = LaravelLocalization::getCurrentLocale();
        $this->url_language_id    = getLangId($lang_code);
    }

    /**
     * list of orders
     *
     * @return All Orders
     * @author 
     **/
    public function index()
    {
    	$orders = Order::with('relTickets')->orderBy('id', 'DESC' )->paginate(30);
//        dd($orders);
    	return View::make('admin.list_orders')
				->with('orders', $orders);
    }

    /**
     * Edit a Order
     *
     * @return order
     * @author 
     **/
    public function edit($id)
    {
    	$order = Order::find($id);
    	$order_items = DB::table('order_items')
            ->select('order_items.*','users.id as user_id')
            ->join('products','products.id','=','order_items.product_id','left')
            ->join('users','users.id','=','products.user_id','left')
            ->where('order_items.order_id', $id)
            ->get();
//        dd($order_items);
        $tickets=Ticket::where('order_id',$id)->get();
    	return View::make('admin.edit_order')
				->with('order', $order)
				->with('tickets', $tickets)
				->with('order_items', $order_items);
    }

    /**
     * Save a Order
     *
     * @return save order
     * @author 
     **/
    public function update()
    {
        $id = Input::get('order_id');
    	$order = Order::find($id);
        $order->status = Input::get('status');
        if($order->save()){
    	   return Redirect::route('orders');
        }
        return Redirect::back();
    }
    public function orders()
    {
        if(Auth::user()->type=='client')
        {
            $data['categories'] = DB::table('category_content')
                ->join('categories', 'category_content.cat_id', '=', 'categories.id')
                ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
                ->where('category_content.lang_id', $this->url_language_id)
                ->orderBy('category_content.id', 'asc')
                ->get();
            $data['districts'] = District::all();
            $data['orders'] = Order::where('user_id',Auth::user()->id)->orderBy('id', 'DESC' )->paginate(10);
            return View::make('front.orders',$data);
        }else{
            return Redirect::back();

        }
    }
    public function order_details($order_id)
    {
        if(Auth::user()->type=='client') {
            $data['categories'] = DB::table('category_content')
                ->join('categories', 'category_content.cat_id', '=', 'categories.id')
                ->select('category_content.id', 'category_content.cat_id', 'categories.state', 'categories.image', 'categories.icon', 'category_content.title', 'category_content.description')
                ->where('category_content.lang_id', $this->url_language_id)
                ->orderBy('category_content.id', 'asc')
                ->get();
            $data['districts'] = District::all();
            //CartController::sentOrderConfirmMail($order_id);
            $data['order'] = Order::find($order_id);
            $data['order_items'] = DB::table('order_items')
                ->where('order_items.order_id', $order_id)
                ->get();
            return View::make('front.order_details', $data);
        }else{
            return Redirect::back();

        }
    }


    /**
     * @param $provider_id
     */
    public function orders_per_provider($provider_id)
    {

        /*$orders = Order::orderBy('id', 'DESC' )->paginate(10);
        return View::make('admin.list_orders')
            ->with('orders', $orders);*/

        $orders = DB::table('orders')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('product_content', 'product_content.product_id', '=', 'products.id')
            ->select('orders.id', 'orders.order_number','orders.status', 'orders.price', 'orders.qty' )
            ->where('product_content.lang_id' , '=', langId())
            ->where('products.user_id' , '=', $provider_id)
            ->get();

        return View::make('admin.views.list_orders_per_provider',array('provider_id'=>$provider_id))
            ->with('orders', $orders);

    }

}