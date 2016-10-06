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
    	$orders = Order::orderBy('id', 'DESC' )->paginate(10);
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
		            ->where('order_items.order_id', $id)
		            ->get();
    	return View::make('admin.edit_order')
				->with('order', $order)
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
            $data['order'] = Order::find($order_id);
            $data['order_items'] = DB::table('order_items')
                ->where('order_items.order_id', $order_id)
                ->get();
            return View::make('front.order_details', $data);
        }else{
            return Redirect::back();

        }
    }

}