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
     **/    public function index()
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

}