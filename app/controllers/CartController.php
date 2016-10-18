<?php
class CartController extends BaseController {
	
	public function __construct()
	{
		$lang_code = LaravelLocalization::getCurrentLocale();
		$this->url_language_id    = getLangId($lang_code);
	}

	public function add()
	{
		$already_in_cart = Cart::search(array('id' => Input::get('id'), 'options' => array('loc_id' => Input::get('location'))));

		################################################################################################################################
		$product = Location::where( 'product_id', '=', Input::get('id') )->where( 'id', '=', Input::get('location') )->first();
		################################################################################################################################
		if(!isset($already_in_cart[0])){
			Cart::add(array(
				'id' => Input::get('id'),
				'name' => Input::get('title'),
				'qty' => Input::get('total_qty'),
				'price' => $product->price1,
				'options' => array(
					'loc_id' => Input::get('location'),
					'pdf' => Input::get('pdf'),
					'mail' => Input::get('mail'),
					'gift' => Input::get('gift')
				)
			));
		}else{
			$rowId = $already_in_cart[0];
			$item = Cart::get($rowId);
			$total_qty = $item->qty + Input::get('total_qty');
			$total_price = $item->price + Input::get('total_price');
			$total_pdf = $item->options['pdf'] + Input::get('pdf');
			$total_mail = $item->options['mail'] + Input::get('mail');
			$total_gift = $item->options['gift'] + Input::get('gift');
			Cart::update($rowId,
				array(
					'qty' => $total_qty,
					'price' => $total_price,
					'options' => array(
						'pdf' => $total_pdf,
						'mail' => $total_mail,
						'gift' => $total_gift
					)
				)
			);
		}
		if(Input::get('type') == 'checkout'){
			if (Auth::check())
			{
				return Redirect::route('checkout');
			}else{
				return Redirect::route('login_checkout');
			}
		}else{
			return Redirect::route('cart');
		}
	}

	public function showLoginCheckout()
	{
		if(Auth::check() || Session::has('guest')){
			return Redirect::route('checkout');
		}
		$categories = DB::table('category_content')
			->join('categories', 'category_content.cat_id', '=', 'categories.id')
			->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
			->where('category_content.lang_id', $this->url_language_id)
			->orderBy('category_content.id', 'asc')
			->get();
		$cart_con 	= Cart::content();
		$total 		= Cart::total();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
			->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
			->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		return View::make('front.login_checkout')
			->with('categories', $categories)
			->with('cart_con', $cart_con)
			->with('districts', $districts)
			->with('tags',$tags)
			->with('total', $total);
	}

	public function processLoginCheckout()
	{
		if (Auth::check())
		{
			return Redirect::route('checkout');
		}else{
			$email = Input::get('login-email');
			$password = Input::get('login-password');
			$rules = array(
				'login-password' => 'required|min:3',
				'login-email' => 'required|email');

			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
			{
				return Redirect::to('login-checkout')->withErrors($validator);
			}else{
				if (Auth::attempt(array('email' => $email, 'password' => $password)))
				{
					return Redirect::route('checkout');
				}
				return Redirect::route('login_checkout');
			}
		}
	}

	public function processGuestCheckout()
	{
		if (Auth::check())
		{
			return Redirect::route('checkout');
		}else{
			$f_name = Input::get('first_name');
			$l_name = Input::get('last_name');
			$email = Input::get('email');
			$passport = Input::get('passport');
			$direction = Input::get('direction');
			$flat = Input::get('flat');
			$dep = Input::get('dep');
			$district = Input::get('district');
			$city = Input::get('city');
			$province = Input::get('province');
			$phone = Input::get('phone');
			$rules = array( 'first_name' => 'required|Between:2,49',
				'last_name' => 'required|Between:2,49',
				'email' => 'required|email|Between:5,49|unique:users',
				'direction' => 'required|Between:2,49',
				'district' => 'required',
				'city' => 'required|Between:2,29',
				'province' => 'required',
				'phone' => 'required|numeric|digits_between:5,15');
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
			{
				return Redirect::to('login-checkout')->withInput()->withErrors($validator);
			}else{
			    $data=Input::except('_token');
                $data['type']='guest';
                $data['username']='guest'.time();
//                dd($data);
                $user=User::create($data);
//                dd($user);
				Session::push('guest.id', $user->id);
				Session::push('guest.f_name', $f_name);
				Session::push('guest.l_name', $l_name);
				Session::push('guest.email', $email);
				Session::push('guest.passport', $passport);
				Session::push('guest.direction', $direction);
				Session::push('guest.flat', $flat);
				Session::push('guest.dep', $dep);
				Session::push('guest.district', $district);
				Session::push('guest.city', $city);
				Session::push('guest.province', $province);
				Session::push('guest.phone', $phone);
				return Redirect::route('checkout');
			}
		}
	}

	public function update_account()
	{
		if (Auth::check())
		{
			$rules = array( 'f-name' => 'required|Between:2,49',
				'l-name' => 'required|Between:2,49',
				'direction' => 'required|Between:2,49',
				'district' => 'required',
				'city' => 'required|Between:2,29',
				'phone' => 'required|numeric|digits_between:5,15');
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
			{
				return Redirect::route('checkout')->withErrors($validator);
			}else{
				$user = User::find(Auth::id());
				$user->first_name = Input::get('f-name');
				$user->last_name = Input::get('l-name');

				$user->direction = Input::get('direction');

				$user->district = Input::get('district');
				$user->city = Input::get('city');
				$user->phone = Input::get('phone');
				$user->save();
				return Redirect::route('checkout');
			}

		}
	}

	public function update()
	{
		// return Input::all();
		$ex_qty			= Input::get('ex_qty');
		$new_qty		= Input::get('new_qty');
		$total_qty 		= Input::get('total_qty');
		$product_type	= Input::get('product_type');
		$product_id     = Input::get('pid');
		$loc_id 		= Input::get('loc');
		$already_in_cart 	= Cart::search(array('id' => $product_id, 'options' => array('loc_id' => $loc_id)));
		// dd($already_in_cart);
		$rowId 	= $already_in_cart[0];
		$item 	= Cart::get($rowId);
		$total_qty 	= $total_qty + $new_qty - $ex_qty;
		if($total_qty == 0) {
			return Cart::remove($rowId);
		}
		$pdf_qty	= $item->options['pdf'];
		$mail_qty	= $item->options['mail'];
		$gift_qty	= $item->options['gift'];
		if($product_type == 'pdf') {
			$total_price 	= getPdfPrice($loc_id,$new_qty) + getMailPrice($loc_id,$mail_qty) + getGiftPrice($loc_id,$gift_qty);
			$total_pdf 		= $new_qty;
			$total_mail 	= $mail_qty;
			$total_gift 	= $gift_qty;
		} elseif($product_type == 'mail')
		{
			$total_price 	= getPdfPrice($loc_id,$pdf_qty) + getMailPrice($loc_id,$new_qty) + getGiftPrice($loc_id,$gift_qty);
			$total_pdf 		= $pdf_qty;
			$total_mail 	= $new_qty;
			$total_gift 	= $gift_qty;
		} else {
			$total_price 	= getPdfPrice($loc_id,$pdf_qty) + getMailPrice($loc_id,$mail_qty) + getGiftPrice($loc_id,$new_qty);
			$total_pdf 		= $pdf_qty;
			$total_mail 	= $mail_qty;
			$total_gift 	= $new_qty;
		}
		Cart::update($rowId,
			array(
				'qty' 	=> $total_qty,
				'price' => $total_price,
				'options' => array(
					'pdf' 	=> $total_pdf,
					'mail' 	=> $total_mail,
					'gift' 	=> $total_gift
				)
			)
		);
	}

	public function showCart()
	{
		// return Cart::content();
		$categories = DB::table('category_content')
			->join('categories', 'category_content.cat_id', '=', 'categories.id')
			->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
			->where('category_content.lang_id', $this->url_language_id)
			->orderBy('category_content.id', 'asc')
			->get();
		$cart_con 	= Cart::content();
		$total 		= Cart::total();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
			->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
			->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		return View::make('front.cart')
			->with('categories', $categories)
			->with('cart_con', $cart_con)
			->with('districts', $districts)
			->with('tags',$tags)
			->with('total', $total);
	}

	public function showCheckout()
	{

		if(Auth::check() || Session::has('guest')){
			$categories = DB::table('category_content')
				->join('categories', 'category_content.cat_id', '=', 'categories.id')
				->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
				->where('category_content.lang_id', $this->url_language_id)
				->orderBy('category_content.id', 'asc')
				->get();
			$cart_con 	= Cart::content();
			$total 		= Cart::total();
			$districts = District::orderBy('name', 'ASC')->get();
			$tags = DB::table('products')
				->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
				->get();
			$tags = array_unique(explode(",",$tags[0]->tags));
			return View::make('front.checkout')
				->with('categories', $categories)
				->with('cart_con', $cart_con)
				->with('districts', $districts)
				->with('tags',$tags)
				->with('total', $total);
		}else{
			return Redirect::route('login_checkout');
		}
	}

	public function processCheckout()
	{

		if(Auth::check() ){
			if( Auth::user()->first_name == '' || Auth::user()->last_name == '' || Auth::user()->direction == '' || Auth::user()->district == '' || Auth::user()->city == '' || Auth::user()->phone == ''){
				return Redirect::route('checkout');
			}
		}

		$order_number = str_random(15);
		$total_qty = Input::get('qty');
		$total_price = Input::get('price');
		$status = 'PENDING';
		$order = new Order;
		$order->order_number = $order_number;
		if (Auth::check())
		{
			$order->user_id = Auth::id();
		}else{
		    $order->user_id=Session::get('guest.id.0');
        }
		$order->status = $status;
		$order->qty = $total_qty;
		$order->price = $total_price;


		if($order->save()){

			foreach (Cart::content() as $cart) {
				$gift = array();
				$mail= array();
				$pdf= array();
				$detail = array();

				if(Input::get('qty_pdf')[$cart->id] > 0){
					$email_pdf = Input::get('email_pdf')[$cart->id];
					$date_pdf = Input::get('date_pdf')[$cart->id];
					$from_pdf = Input::get('from_pdf')[$cart->id];
					$to_pdf = Input::get('to_pdf')[$cart->id];
					$msg_pdf = Input::get('msg_pdf')[$cart->id];
					$pdf = array(
						'email' => $email_pdf,
						'date' => $date_pdf,
						'from' => $from_pdf,
						'to' => $to_pdf,
						'msg' => $msg_pdf
					);

				}
				if(Input::get('qty_mail')[$cart->id] > 0){
					$address_mail = Input::get('mailAddress_mail')[$cart->id];
					$shipping_mail = Input::get('mailshipping_mail')[$cart->id];
					$date_mail = Input::get('date_mail')[$cart->id];
					$from_mail = Input::get('from_mail')[$cart->id];
					$to_mail = Input::get('to_mail')[$cart->id];
					$msg_mail = Input::get('msg_mail')[$cart->id];
					$mail = array(
						'address' => $address_mail,
						'shipping' => $shipping_mail,
						'date' => $date_mail,
						'from' => $from_mail,
						'to' => $to_mail,
						'msg' => $msg_mail
					);

				}
				if(Input::get('qty_gift')[$cart->id] > 0){
					$address_gift = Input::get('giftAddress_gift')[$cart->id];
					$shipping_gift = Input::get('giftshipping_gift')[$cart->id];
					$date_gift = Input::get('date_gift')[$cart->id];
					$from_gift = Input::get('from_gift')[$cart->id];
					$to_gift = Input::get('to_gift')[$cart->id];
					$msg_gift = Input::get('msg_gift')[$cart->id];
					$gift = array(
						'address' => $address_gift,
						'shipping' => $shipping_gift,
						'date' => $date_gift,
						'from' => $from_gift,
						'to' => $to_gift,
						'msg' => $msg_gift
					);

				}
				$detail = array(
					'pdf' => $pdf,
					'mail' => $mail,
					'gift' => $gift
				);

				$order_items = new OrderItems;
				$order_items->order_id = $order->id;
				$order_items->product_id = $cart->id;
				$order_items->loc_id = $cart->options['loc_id'];
				$order_items->pdf_qty = $cart->options['pdf'];
				$order_items->pdf_price = getPdfPriceWithoutDecimal($cart->options['loc_id'], $cart->options['pdf']);
				$order_items->mail_qty = $cart->options['mail'];
				$order_items->mail_price = getMailPrice($cart->options['loc_id'], $cart->options['mail']);
				$order_items->gift_qty = $cart->options['gift'];
				$order_items->gift_price = getGiftPrice($cart->options['loc_id'], $cart->options['gift']);
				$order_items->details = json_encode($detail);
				$order_items->save();
			}

			/*
			 * Start Sent mail to provider,admin and client with order details
			 * */
            $data['order'] = Order::find($order->id);
            $data['order_items'] = DB::table('order_items')
                ->where('order_items.order_id', $order->id)
                ->get();

            /*Mail::send('emails.order_details', $data, function($message)
            {
                $message->subject('A new Order has been placed');
                $message->from('us@example.com', 'Expoor');
                $message->to('devdhaka404@gmail.com')->cc('devdhaka404@gmail.com');
                #$message->attach($pathToFile);
            });*/



			/*
			 * End Sent mail to provider,admin and client with order details
			 * */
			if(Input::get('payment_gateway') == 'culqi')
			{

				$price = DB::table('orders')->where('order_number','=', $order_number)->pluck('price');
				if (Auth::check())
				{
					$email = Auth::user()->email;
					$first_name = Auth::user()->first_name;
					$last_name = Auth::user()->last_name;
					$address = Auth::user()->direction.', '.Auth::user()->district;
					$city = Auth::user()->city;
					$phone = Auth::user()->phone;
				}else{
					$email = Session::get('guest.email')[0];
					$first_name = Session::get('guest.f_name')[0];
					$last_name = Session::get('guest.l_name')[0];
					$address = Session::get('guest.direction')[0].', '.Session::get('guest.district')[0];
					$city = Session::get('guest.city')[0];
					$phone = Session::get('guest.phone')[0];
				}

				CartController::sentOrderConfirmMail($order->id);
				require public_path().'/culqi.php';
				Culqi::$codigoComercio = "9preKzsz6VbY";
				Culqi::$llaveSecreta = "QJg/85cKQI/EXDSBlr+2j/l/TSlstk59GFUZwdIBciA=";
				Culqi::$servidorBase = 'https://pago.culqi.com';


				try {

					$data = Pago::crearDatospago(array(
						//Numero de pedido de la venta
						Pago::PARAM_NUM_PEDIDO => $order_number,
						//Moneda de la venta ("PEN" O "USD")
						Pago::PARAM_MONEDA => "PEN",
						//Monto de la venta (ejem: 10.25, va sin el punto decimal)
						Pago::PARAM_MONTO => convertAmount($price),
						//Descripción de la venta
						Pago::PARAM_DESCRIPCION => "Wayna's Experiences",
						//Código del país del cliente Ej. PE, US
						Pago::PARAM_COD_PAIS => "PE",
						//Ciudad del cliente
						Pago::PARAM_CIUDAD => $city,
						//Dirección del cliente
						Pago::PARAM_DIRECCION => $address,
						//Número de teléfono del cliente
						Pago::PARAM_NUM_TEL => $phone,
						//Correo electrónico del cliente
						"correo_electronico" => $email,
						//Id de usuario del cliente
						"id_usuario_comercio" => $email,
						//Nombre del cliente
						"nombres" => $first_name,
						//Apellido del cliente
						"apellidos" => $last_name,
					));
					//exit("OK");

					//Respuesta de la creación de la venta. Cadena cifrada.
					$informacionVenta = $data[Pago::PARAM_INFO_VENTA];
					if(Auth::check() || Session::has('guest')){
						return Response::json(array('method' => 'culqi', 'state' => 'success', 'order_number' => $order_number, 'informacionVenta'=> $informacionVenta));
					}else{
						return Response::json(array('method' => 'culqi', 'state' => 'fail', 'order_number' => $order_number));
					}

				} catch (InvalidParamsException $e) {
					return Response::json(array('method' => 'culqi', 'state' => 'fail', 'order_number' => $order_number));
				}
				//return Redirect::route('culqi', array($order_number));
			}
			elseif(Input::get('payment_gateway') == 'agente_bcp')
			{
				//exit("ELSE");
				return Response::json(array('method' => 'agente_bcp', 'state' => 'success', 'order_number' => $order_number));
				//return Redirect::route('agente_bcp', array($order_number));
			}
		}
	}

	public function culqi($order_number)
	{
		$price = DB::table('orders')->where('order_number','=', $order_number)->pluck('price');
		if (Auth::check())
		{
			$email = Auth::user()->email;
			$first_name = Auth::user()->first_name;
			$last_name = Auth::user()->last_name;
			$address = Auth::user()->direction.', '.Auth::user()->district;
			$city = Auth::user()->city;
			$phone = Auth::user()->phone;
		}else{
			$email = Session::get('guest.email')[0];
			$first_name = Session::get('guest.f_name')[0];
			$last_name = Session::get('guest.l_name')[0];
			$address = Session::get('guest.direction')[0].', '.Session::get('guest.district')[0];
			$city = Session::get('guest.city')[0];
			$phone = Session::get('guest.phone')[0];
		}
		require public_path().'/culqi.php';
		Culqi::$codigoComercio = "9preKzsz6VbY";
		Culqi::$llaveSecreta = "QJg/85cKQI/EXDSBlr+2j/l/TSlstk59GFUZwdIBciA=";
		Culqi::$servidorBase = 'https://pago.culqi.com';

		try {
			$data = Pago::crearDatospago(array(
				//Numero de pedido de la venta
				Pago::PARAM_NUM_PEDIDO => $order_number,
				//Moneda de la venta ("PEN" O "USD")
				Pago::PARAM_MONEDA => "PEN",
				//Monto de la venta (ejem: 10.25, va sin el punto decimal)
				Pago::PARAM_MONTO => $price,
				//Descripción de la venta
				Pago::PARAM_DESCRIPCION => "Wayna's Experiences",
				//Código del país del cliente Ej. PE, US
				Pago::PARAM_COD_PAIS => "PE",
				//Ciudad del cliente
				Pago::PARAM_CIUDAD => $city,
				//Dirección del cliente
				Pago::PARAM_DIRECCION => $address,
				//Número de teléfono del cliente
				Pago::PARAM_NUM_TEL => $phone,
				//Correo electrónico del cliente
				"correo_electronico" => $email,
				//Id de usuario del cliente
				"id_usuario_comercio" => $email,
				//Nombre del cliente
				"nombres" => $first_name,
				//Apellido del cliente
				"apellidos" => $last_name,
			));
			//Respuesta de la creación de la venta. Cadena cifrada.
			$informacionVenta = $data[Pago::PARAM_INFO_VENTA];

			if(Auth::check() || Session::has('guest')){
				$categories = DB::table('category_content')
					->join('categories', 'category_content.cat_id', '=', 'categories.id')
					->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
					->where('category_content.lang_id', $this->url_language_id)
					->orderBy('category_content.id', 'asc')
					->get();
				$cart_con 	= Cart::content();
				$total 		= Cart::total();
				$districts = District::orderBy('name', 'ASC')->get();
				$tags = DB::table('products')
					->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					->get();
				$tags = array_unique(explode(",",$tags[0]->tags));
				return View::make('front.process_checkout')
					->with('categories', $categories)
					->with('cart_con', $cart_con)
					->with('districts', $districts)
					->with('tags',$tags)
					->with('total', $total)
					->with('order_number', $order_number)
					->with('informacionVenta', $informacionVenta);
			}else{
				return Redirect::route('login_checkout');
			}

		} catch (InvalidParamsException $e) {
			return Redirect::back()->withErrors($e->getMessage());
		}
	}

	public function culqiIPN()
	{
		require public_path().'/culqi.php';
		Culqi::$codigoComercio = "9preKzsz6VbY";
		Culqi::$llaveSecreta = "QJg/85cKQI/EXDSBlr+2j/l/TSlstk59GFUZwdIBciA=";
		Culqi::$servidorBase = 'https://pago.culqi.com';
		try {
			$inputJSON = file_get_contents('php://input');
			$input= json_decode( $inputJSON, TRUE );
			if($input['respuesta'] == 'checkout_cerrado' || $input['respuesta'] == 'venta_expirada'){
				return $input['respuesta'];
			}else{
				$data = json_decode(Culqi::decifrar($input['respuesta']), TRUE);
				if($data["codigo_respuesta"] == 'venta_exitosa'){
					$order_number = $data["numero_pedido"];
					DB::table('orders')
						->where('order_number', $order_number)
						->update(array('status' => 'SUCCESS'));
					$order=Order::where('order_number', $order_number)->first();
					//$this->orderMail($order_number);
					/************************ envia emails ************************/
					$price = DB::table('orders')->where('order_number','=', $order_number)->pluck('price');
					$orders = DB::table('order_items')
						->join('orders', 'order_items.order_id', '=', 'orders.id')
						->where('orders.order_number', $order_number)
						->orderBy('order_items.id', 'asc')
						->get();

					$email = Auth::user()->email;
					$first_name = Auth::user()->first_name;
					$last_name = Auth::user()->last_name;
					$name = $first_name.' '.$last_name;
					$params = array('order_number'=>$order_number,'email'=>$email, 'name'=>$name,'price'=>$price, 'orders' => $orders);

					Mail::send('emails.agentebcp', $params, function($message) use ($email, $name) {
						$message->from('ventas@waynaperu.com', 'Ventas Wayna');
						$message->to($email, $name)->subject(trans('text.culqi_subject'));
					});

					Mail::send('emails.culqi', $params, function($message) use ($email, $name) {
						$message->from('ventas@waynaperu.com', 'Ventas Wayna');
						$message->to('info@waynaperu.com', 'Info Wayna')->subject(trans('text.culqi_subject'));
					});
                    TicketController::create($order->id);
					/************************ envia emails ************************/

					Cart::destroy();
				}
				return json_encode($data);
			}
		} catch (InvalidParamsException $e) {
			return $e->getMessage()."\n";
		}
	}

	public function agenteBCP($order_number)
	{
		$price = DB::table('orders')->where('order_number','=', $order_number)->pluck('price');
		$orders = DB::table('order_items')
			->join('orders', 'order_items.order_id', '=', 'orders.id')
			->where('orders.order_number', $order_number)
			->orderBy('order_items.id', 'asc')
			->get();
		if (Auth::check())
		{
			$email = Auth::user()->email;
			$first_name = Auth::user()->first_name;
			$last_name = Auth::user()->last_name;
			$address = Auth::user()->direction.', '.Auth::user()->district;
			$city = Auth::user()->city;
		}else{
			$email = Session::get('guest.email')[0];
			$first_name = Session::get('guest.f_name')[0];
			$last_name = Session::get('guest.l_name')[0];
			$address = Session::get('guest.direction')[0].', '.Session::get('guest.district')[0];
			$city = Session::get('guest.city')[0];
		}

		$name = $first_name.' '.$last_name;
		$params = array('order_number'=>$order_number,'email'=>$email, 'name'=>$name,'price'=>$price, 'orders' => $orders);
		Mail::send('emails.agentebcp', $params, function($message) use ($email, $name) {
			$message->from('ventas@waynaperu.com', 'Ventas Wayna');
			$message->to($email, $name)->subject(trans('text.bcp_subject'));
		});

		Mail::send('emails.culqi', $params, function($message) use ($email, $name) {
			$message->from('ventas@waynaperu.com', 'Ventas Wayna');
			$message->to('info@waynaperu.com', 'Info Wayna')->subject(trans('text.bcp_subject'));
		});		

		Cart::destroy();
		
		return Redirect::route('order_success', array($order_number));
	}

	public function orderMail($order_number)
	{
		$price = DB::table('orders')->where('order_number','=', $order_number)->pluck('price');
		$orders = DB::table('order_items')
			->join('orders', 'order_items.order_id', '=', 'orders.id')
			->where('orders.order_number', $order_number)
			->orderBy('order_items.id', 'asc')
			->get();
		if (Auth::check())
		{
			$email = Auth::user()->email;
			$first_name = Auth::user()->first_name;
			$last_name = Auth::user()->last_name;
			$address = Auth::user()->direction.', '.Auth::user()->district;
			$city = Auth::user()->city;
		}else{
			$email = Session::get('guest.email')[0];
			$first_name = Session::get('guest.f_name')[0];
			$last_name = Session::get('guest.l_name')[0];
			$address = Session::get('guest.direction')[0].', '.Session::get('guest.district')[0];
			$city = Session::get('guest.city')[0];
		}

		$name = $first_name.' '.$last_name;

		Mail::send('emails.culqi', array('order_number'=>$order_number,'email'=>$email, 'name'=>$name,'price'=>$price, 'orders' => $orders), function($message) use ($email, $name) {
			$message->to($email, $name)->subject(trans('text.culqi_subject'));
		});

		return true;
	}

	public function showOrderSuccess($order_number)
	{

		// Fire email to Client


		if(Auth::check() || Session::has('guest'))
		{
			$categories = DB::table('category_content')
				->join('categories', 'category_content.cat_id', '=', 'categories.id')
				->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
				->where('category_content.lang_id', $this->url_language_id)
				->orderBy('category_content.id', 'asc')
				->get();
			$orders = DB::table('order_items')
				->join('orders', 'order_items.order_id', '=', 'orders.id')
				->where('orders.order_number', $order_number)
				->orderBy('order_items.id', 'asc')
				->get();
			$products = DB::table('product_content')
			    ->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
				->join('products', 'product_content.product_id', '=', 'products.id')
	            ->join('categories', 'products.cat_id', '=', 'categories.id')
	            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')				
				->join('product_images', 'product_images.product_id', '=', 'products.id')
				->where('category_content.lang_id', $this->url_language_id)
				->where('product_content.lang_id', $this->url_language_id)
				->orderBy(DB::raw('RAND()'))
				->take(2)
				->get();
			$districts = District::orderBy('name', 'ASC')->get();
			$tags = DB::table('products')
				->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
				->get();
			$tags = array_unique(explode(",",$tags[0]->tags));
			return View::make('front.order_success')
				->with('categories', $categories)
				->with('orders', $orders)
				->with('products', $products)
				->with('districts', $districts)
				->with('tags',$tags)
				->with('order_number', $order_number);
		}
		else
		{
			return Redirect::route('home');
		}
	}

	public static function sentOrderConfirmMail($order_id)
    {
        $data['order'] = Order::find($order_id);
        $data['order_items'] = DB::table('order_items')
            ->where('order_items.order_id', $order_id)
            ->get();
        $admin=User::select('email')->where('type','admin')->get();
        $emails=[];
        foreach ($admin as $item) {
            $emails[]=$item->email;
        }
        $client=User::find($data['order']->user_id);
        $email_client=$client->email;
        $pathToFile=public_path('images/ticket.jpg');

        /*Mail::send('emails.order_details', $data, function($message) use ($emails,$email_client,$pathToFile,$data)
        {
            $message->subject('Order details for '.$data["order"]->order_number.' no of order from Exploor');
            $message->from('devdhaka404@gmail.com', 'Exploor');

            $message->to($email_client)->bcc($emails);

            $message->attach($pathToFile);
        });*/



        $pe= DB::table('order_items');
        $pe= $pe->select('users.email','products.*','locations.price1 as price');
        $pe= $pe->join('products','products.id','=','order_items.product_id','left');
		$pe= $pe->join('locations','locations.product_id','=','products.id','left');
		$pe= $pe->join('users','users.id','=','products.user_id','left');
		$pe= $pe->where('order_items.order_id',$order_id);
		$pe= $pe->get();


        /*foreach ($pe as $item) {
            $item= (array) $item;
             Mail::send('emails.property_details', $item, function($message) use ($item)
            {
                $message->subject('New product sold');
                $message->from('devdhaka404@gmail.com', 'Exploor');
                $message->to($item['email']);
            });
        }*/
		//exit('ok');

	}

}
