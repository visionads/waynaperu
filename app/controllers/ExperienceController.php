<?php

class ExperienceController extends BaseController {

	private  $url_language_id;

    public function __construct()
    {	

        $lang_code = LaravelLocalization::getCurrentLocale();

        $this->url_language_id = getLangId($lang_code);
    }

	public function showExp($id)
	{
		$exp_id 		= $id;
		$cat_id 		= Product::where('id', '=', $exp_id)->pluck('cat_id');
		$location_id 	= Product::where('id', '=', $exp_id)->pluck('first_loc_id');
		$hits_count 	= Product::where('id', '=', $exp_id)->pluck('hits');
		$product_update = Product::find($exp_id);
		$product_update->hits =  $hits_count + 1;
		$product_update->save();

		$cat = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('categories.id','category_content.title')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('categories.id', $cat_id)
		            ->first();

		// Categories
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();

        // General FAQ's
		$g_faqs	= DB::table('faqcontents')
				->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
				->select('faqcontents.que', 'faqcontents.ans', 'faqs.state')
				->where('faqcontents.lang_id', $this->url_language_id)
				->where('faqs.product_id', '=', NULL)
				->orderBy(DB::raw('RAND()'))
		     	->take(3)
		     	->get();

		// Experience FAQ's
		$e_faqs	= DB::table('faqcontents')
				->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
				->select('faqcontents.que', 'faqcontents.ans', 'faqs.state')
				->where('faqcontents.lang_id', $this->url_language_id)
				->where('faqs.product_id', '=', $exp_id)
				->orderBy(DB::raw('RAND()'))
		     	->take(3)
		     	->get();

		if(isset($location_id)) {
	        // First Order Location 
			$loc = DB::table('location_content')
				->join('locations', 'location_content.loc_id', '=', 'locations.id')
				->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3')
				->where('locations.product_id', '=', $exp_id)
				->where('locations.id', '=', $location_id)
				->where('location_content.lang_id', $this->url_language_id)
				->take(1)
				->first();

			// Locations except first one
			$locations	= DB::table('location_content')
	        			->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3', 'locations.id')
	        			->where('locations.product_id', '=', $exp_id)
	        			->where('location_content.lang_id', $this->url_language_id)
	        			->where('locations.id', '!=', $location_id)
	        			->orderBy('location_content.name', 'asc')
	        			->get();

			// Locations except first one
			$first_loc	= DB::table('location_content')
	        			->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			->select('location_content.name', 'locations.id')
	        			->where('locations.product_id', '=', $exp_id)
	        			->where('location_content.lang_id', $this->url_language_id)
	        			->where('locations.id', '=', $location_id)
	        			->take(1)
	        			->first();
		} else {
	        // First Location from Pool
			$loc = DB::table('location_content')
				->join('locations', 'location_content.loc_id', '=', 'locations.id')
				->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3')
				->where('locations.product_id', '=', $exp_id)
				->where('location_content.lang_id', $this->url_language_id)
				->take(1)
				->first();

			// Locations
			$locations	= DB::table('location_content')
	        			->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3', 'locations.id')
	        			->where('locations.product_id', '=', $exp_id)
	        			->where('location_content.lang_id', $this->url_language_id)
	        			->orderBy('location_content.name', 'asc')
	        			->get();
		}

		// Min Price
		$min_price	= DB::table('locations')
        			->select('locations.price1')
        			->where('locations.product_id', '=', $exp_id)
        			->min('locations.price1');

        // Product Images
       	$p_images	= DB::table('product_images')
        			->select('image', 'order')
        			->where('product_id', '=', $exp_id)
        			->get();

		$p_content	= DB::table('product_content')
        			->select('title', 'description', 'product_id')
        			->where('product_id', '=', $exp_id)
        			->where('lang_id', $this->url_language_id)
        			->first();

		$products = DB::table('product_content')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
					->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.cat_id', '=', $cat_id )
		            ->where('products.id', '!=', $exp_id )
		            ->where('products.state', '1')
		            ->groupBy('product_images.product_id')
		            ->orderBy(DB::raw('RAND()'))
		            ->take(6)
		            ->get();

		$districts = District::orderBy('name', 'ASC')->get();

		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));		

		if(isset($location_id)) {
			return View::make('front.experience')
						->with('categories',$categories)
						->with('p_content',$p_content)
						->with('p_images',$p_images)
						->with('g_faqs',$g_faqs)
						->with('e_faqs',$e_faqs)
						->with('products',$products)
						->with('locations',$locations)
						->with('min_price', $min_price)
						->with('loc',$loc)
						->with('districts',$districts)
						->with('first_loc', $first_loc)
						->with('tags', $tags)
						->with('p', $product_update)
						->with('cat',$cat);

		} else {
			return View::make('front.experience')
						->with('categories',$categories)
						->with('p_content',$p_content)
						->with('p_images',$p_images)
						->with('g_faqs',$g_faqs)
						->with('e_faqs',$e_faqs)
						->with('products',$products)
						->with('locations',$locations)
						->with('min_price', $min_price)
						->with('loc',$loc)
						->with('districts',$districts)
						->with('tags', $tags)
						->with('p', $product_update)
						->with('cat',$cat);

		}

	}

	public function contactProvider()
	{
		$name = Input::get('lead_name');
		$email = Input::get('lead_email');
		$phone = Input::get('lead_phone');
		$p_id = Input::get('p_id');
		$loc_id = Input::get('loc_id');
		$product = Product::find($p_id);
		$rules = array( 'lead_name' => 'required|Between:2,49',
				        'lead_email' => 'required|email|Between:5,49',
				        'lead_phone' => 'required|numeric|digits_between:5,15');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
	    {
	        return Redirect::back()->with('msg', 'fail')->withInput()->withErrors($validator);
	    }else{
			$lead_email = $product->lead_email;
			$lead_name = $product->lead_name;
			Mail::send('emails.leads', array('email'=>$email, 'name'=>$name,'phone'=>$phone, 'p_id' => $p_id, 'loc_id' => $loc_id), function($message) use ($lead_email, $lead_name) {
			    $message->to('info@exploor.pe', 'Exploor')->to($lead_email, $lead_name)->subject('New Lead');
			});
			Mail::send('emails.user_leads', array('product'=>$product, 'p_id' => $p_id, 'loc_id' => $loc_id), function($message) use ($email, $name) {
			    $message->to($email, $name)->subject('Lead Details');
			});
			 return Redirect::back()->with('msg', 'Successfull');
		}
	}

	public function getLocData() 
	{
		$loc_id    	= Input::get('id');

		// Get location based data

		$data 		= DB::table('location_content')

						->join('locations', 'location_content.loc_id', '=', 'locations.id')

						->select('location_content.details', 'locations.price1', 'locations.price2', 'locations.price3')

	        			->where('locations.id', '=', $loc_id)

	        			->where('location_content.lang_id', $this->url_language_id)

	        			->first();



     	$loc_details 	= json_decode($data->details);

		$details 	= '';

		

		foreach($loc_details as $key => $value) {

			$details .= '<div class="col-md-5">

			   				<p><strong>'.$key.': <br/></strong></p>	';
			   				$detail_lists = explode("//",$value); 
            $details .= '<ul>';
                          foreach($detail_lists as $detail_list){
            $details .='<li style="margin-bottom:5px;">'. $detail_list .'</li>';
                          }
            $details .= '</ul>';

			$details .= '</div>';

		}

		$priceHTML 	= 	'<div class="select_row">

	                 		<div class="loc-price pdf-price">s/.<span>'.$data->price1.'</span></div>

	                 		<div class="loc-price mail-price">s/.<span>'.$data->price2.'</span></div>

	                 		<div class="loc-price gift-price">s/.<span>'.$data->price3.'</span></div>

	                 	</div>';

	    /*echo $priceHTML;

	    die();*/



        $discount_price1=0;
        $discount_price2=0;
        if(isset($data->price3) && $data->price3 != 0.00)
        {
            $discount_price1= $data->price1-(($data->price1/100))*$data->price3;
            $discount_price2= $data->price2-(($data->price2/100))*$data->price3;
        }
		return Response::json(array('details' => $details, 'priceHTML' => $priceHTML, 'price1' => $data->price1, 'price2' => $data->price2, 'price3' => $data->price3, 'discount_price1' => $discount_price1, 'discount_price2' => $discount_price2));
	}

	public function show($category_name, $product_name, $product_id)
	{
		$product = DB::table('product_content')
		            ->select('*','products.cat_id', 'product_content.title as product_title', 'product_content.mini_description', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id','left')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.id', $product_id)
		            ->first();

		if( is_null($product) ) {
			App::abort(404);
		}
		//exit('ok');

		// update hits
		$product_update = Product::where('id', '=', $product_id)->first();
		$product_update->hits = $product_update->hits + 1;
		$product_update->save();

		$exp_id = $product_update->id;
		$cat_id = $product_update->cat_id;
		$location_id = $product_update->first_loc_id;

		// get content category
		$cat = DB::table('category_content')
		         ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		         ->select('categories.id','category_content.title')
		         ->where('category_content.lang_id', $this->url_language_id)
		         ->where('categories.id', $cat_id)
		         ->first();

		// get categories
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();

		// get faqs
        $g_faqs	= DB::table('faqcontents')
        		 	->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
        			->select('faqcontents.que', 'faqcontents.ans', 'faqs.state')
        			->where('faqcontents.lang_id', $this->url_language_id)
        			->where('faqs.product_id', '=', NULL)
        			->orderBy(DB::raw('RAND()'))
		         	->take(3)
		         	->get();

		// get faqs for product
        $e_faqs	= DB::table('faqcontents')
        			->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
        			->select('faqcontents.que', 'faqcontents.ans', 'faqs.state')
        			->where('faqcontents.lang_id', $this->url_language_id)
        			->where('faqs.product_id', '=', $exp_id)
        			->orderBy(DB::raw('RAND()'))
		         	->take(3)
		         	->get();		



		if( isset($location_id)) {
			$loc = DB::table('location_content')
	        		 ->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        		 ->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3')
	        		 ->where('locations.product_id', '=', $exp_id)
	        		 ->where('locations.id', '=', $location_id)
	        		 ->where('location_content.lang_id', $this->url_language_id)
	        		 ->take(1)
	        		 ->first();

	        // Locations
			$locations	= DB::table('location_content')
	        			    ->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			    ->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3', 'locations.id')
	        			    ->where('locations.product_id', '=', $exp_id)
	        			    ->where('location_content.lang_id', $this->url_language_id)
	        			    ->where('locations.id', '!=', $location_id)
	        			    ->orderBy('location_content.name', 'asc')
	        			    ->get();

			// Locations except first one
			$first_loc	= DB::table('location_content')
	        			    ->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			    ->select('location_content.name', 'locations.id')
	        			    ->where('locations.product_id', '=', $exp_id)
	        			    ->where('location_content.lang_id', $this->url_language_id)
	        			    ->where('locations.id', '=', $location_id)
	        			    ->take(1)
	        			    ->first();
		} else {
	        // First Location from Pool
	        $loc = DB::table('location_content')
	        		 ->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        		 ->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3')
	        		 ->where('locations.product_id', '=', $exp_id)
	        		 ->where('location_content.lang_id', $this->url_language_id)
	        		 ->take(1)
	        		 ->first();

			// Locations
			$locations = DB::table('location_content')
	        			   ->join('locations', 'location_content.loc_id', '=', 'locations.id')
	        			   ->select('location_content.name', 'location_content.details', 'locations.price1', 'locations.price2', 'locations.price3', 'locations.id')
	        			   ->where('locations.product_id', '=', $exp_id)
	        			   ->where('location_content.lang_id', $this->url_language_id)
	        			   ->orderBy('location_content.name', 'asc')
	        			   ->get();
		}

		// Min Price
		$min_price= DB::table('locations')
	    		      ->select('locations.price1')
	    			  ->where('locations.product_id', '=', $exp_id)
	    			  ->min('locations.price1');

		// Min Price
		$child_price= DB::table('locations')
	    		      ->select('locations.price2')
	    			  ->where('locations.product_id', '=', $exp_id)
	    			  ->min('locations.price2');

	    // Product Images
	   	$p_images = DB::table('product_images')
	    			  ->select('image', 'order')
	    			  ->where('product_id', '=', $exp_id)
	    			  ->get();

		$p_content	= DB::table('product_content')
	    			    ->select('title', 'mini_description', 'description', 'product_id')
	    			    ->where('product_id', '=', $exp_id)
	    			    ->where('lang_id', $this->url_language_id)
	    			    ->first();

		$products = DB::table('product_content')
					->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
					->join('categories', 'products.cat_id', '=', 'categories.id')
					->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
					->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.cat_id', '=', $cat_id )
		            ->where('products.id', '!=', $exp_id )
		            ->where('products.state', '1')
		            ->groupBy('product_images.product_id')
		            ->orderBy(DB::raw('RAND()'))
		            ->take(4)
		            ->get();

		$districts = District::orderBy('name', 'ASC')->get();

		$tags = DB::table('products')
				  ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
				  ->get();

		$tags = array_unique(explode(",",$tags[0]->tags));

		if( isset($location_id) ) {
			return View::make('front.experience')
                       ->with('categories',$categories)
			           ->with('p_content',$p_content)
			           ->with('p_images',$p_images)
			           ->with('g_faqs',$g_faqs)
			           ->with('e_faqs',$e_faqs)
			           ->with('products',$products)
			           ->with('locations',$locations)
			           ->with('min_price', $min_price)
			           ->with('child_price', $child_price)
			           ->with('loc',$loc)
			           ->with('districts',$districts)
			           ->with('first_loc', $first_loc)
			           ->with('tags', $tags)
			           ->with('p', $product_update)
			           ->with('product', $product)
			           ->with('cat',$cat);

		} else {
			return View::make('front.experience')
			           ->with('categories',$categories)
			           ->with('p_content',$p_content)
			           ->with('p_images',$p_images)
			           ->with('g_faqs',$g_faqs)
			           ->with('e_faqs',$e_faqs)
			           ->with('products',$products)
			           ->with('locations',$locations)
			           ->with('min_price', $min_price)
			           ->with('child_price', $child_price)
			           ->with('loc',$loc)
			           ->with('districts',$districts)
			           ->with('tags', $tags)
			           ->with('p', $product_update)
					   ->with('product', $product)
			           ->with('cat',$cat);

		}
	}

}

