<?php



class ProductController extends BaseController {



	public function index()
	{
	    if(Auth::user()->type=='admin')
        {
            $products = DB::table('product_content')
                ->join('products', 'product_content.product_id', '=', 'products.id')
                ->join('categories', 'products.cat_id', '=', 'categories.id')
                ->join('category_content', 'category_content.cat_id', '=', 'categories.id')
                ->leftJoin('users', function($join)
                {
                    $join->on('products.user_id', '=', 'users.id')
                        ->where('users.type' , '=', 'provider');
                })

                ->select('product_content.product_id', 'product_content.title','product_content.mini_description', 'category_content.title as cat_title', 'users.username as provider' )
                ->where('products.state' , '!=', '-1')
                ->where('product_content.lang_id' , '=', langId())
                ->orderBy('product_content.product_id', 'asc')

                ->groupBy('product_content.product_id')

                ->get();
        }elseif(Auth::user()->type=='provider')
        {
            $products = DB::table('product_content')

                ->join('products', 'product_content.product_id', '=', 'products.id')
                ->join('categories', 'products.cat_id', '=', 'categories.id')
                ->join('category_content', 'category_content.cat_id', '=', 'categories.id')
                ->leftJoin('users', function($join)
                {
                    $join->on('products.user_id', '=', 'users.id')
                        ->where('users.type' , '=', 'provider');
                })

                ->select('product_content.product_id', 'product_content.title','product_content.mini_description', 'category_content.title as cat_title', 'users.username as provider' )
                ->where('products.state' , '!=', '-1')
                ->where('product_content.lang_id' , '=', langId())
                ->where('products.user_id' , '=', Auth::user()->id)
                ->orderBy('product_content.product_id', 'asc')

                ->groupBy('product_content.product_id')

                ->get();
        }
		return View::make('admin.list_products', array('products' => $products));

	}

	public function add()

	{

		$form_url   = 'admin/product/save';

		$languages = Language::all();

		$category = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.cat_id', 'category_content.title')
		            ->orderBy('category_content.cat_id', 'asc')
		            ->groupBy('category_content.cat_id')
		            ->get();
        $providers= User::select('id','username','first_name','last_name')->where('type','provider')->get();

		return View::make('admin.add_product', array('form_url' => $form_url, 'languages' => $languages, 'category' => $category,'providers'=>$providers));

	}

	public function save()

	{

//	    echo '<pre>';print_r(Input::all());exit;
//		 return Input::all();



		$languages 	= Language::all();
//		$to_whom = Input::get('to_whom');
//		$to_whom = implode(",",$to_whom);

        $cat_id  = Input::get('category');

        $product = new Product;

        $product->cat_id = $cat_id;
        $product->type_of_payment = Input::get('type_of_payment');
        $product->user_id = Input::get('user_id');

        $product->tags = Input::get('tags');
        if(Input::has('is_lead')){
          $product->is_lead = Input::get('is_lead');
        }
        if(Input::has('lead_email')){
        	$product->lead_email = Input::get('lead_email');
        }
        if(Input::has('lead_name')){
        	$product->lead_name = Input::get('lead_name');
        }
        if(Input::has('lead_phone')){
        	$product->lead_phone = Input::get('lead_phone');
        }
        if(Input::has('lead_address')){
        	$product->lead_address = Input::get('lead_address');
        }
//        $product->to_whom = $to_whom;

        if ($product->save()) {

        	# code...

                $p_id = $product->id;
                foreach ($languages as  $language) {
	                $product_content = new ProductContent;
	                $product_content->product_id = $p_id;
	                $product_content->lang_id = $language->id;
	                $product_content->title = Input::get('title')[$language->code];
	                $product_content->mini_description = Input::get('mini_description')[$language->code];
	                $product_content->description = Input::get('description')[$language->code];
	                $product_content->save();

                    $product_info= new ProductInfo();
                    $product_info->product_id= $p_id;
                    $product_info->language_id= $language->id;
                    $product_info->includes= Input::get('includes')[$language->code];
                    $product_info->schedule_short= Input::get('schedule_short')[$language->code];
                    $product_info->duration= Input::get('duration')[$language->code];
                    $product_info->required= Input::get('required')[$language->code];
                    $product_info->terms_of_reservation= Input::get('terms_of_reservation')[$language->code];
                    $product_info->terms_of_cancellation= Input::get('terms_of_cancellation')[$language->code];
                    $product_info->restriction= Input::get('restriction')[$language->code];
                    $product_info->recommendation= Input::get('recommendation')[$language->code];
                    $product_info->not_include= Input::get('not_include')[$language->code];
                    $product_info->other_information= Input::get('other_information')[$language->code];
                    $product_info->validity= Input::get('validity')[$language->code];
                    $product_info->itinerary= Input::get('itinerary')[$language->code];
                    $product_info->department= Input::get('department')[$language->code];
                    $product_info->city= Input::get('city')[$language->code];
                    $product_info->street= Input::get('street')[$language->code];
                    $product_info->district= Input::get('district')[$language->code];
                    $product_info->price_with_tax= Input::get('price_with_tax')[$language->code];
                    $product_info->commission_previous= Input::get('commission_previous')[$language->code];
                    $product_info->final_commission_of_25= Input::get('final_commission_of_25')[$language->code];
                    $product_info->provider_price= Input::get('provider_price')[$language->code];
                    $product_info->save();
	            }

				// BO File Upload Code
		    	$tableName 	= 'product_images';
		    	$fieldName 	= 'image';

		    	if(Input::hasFile('pimages')){
		    	   $files = Input::file('pimages');
		           foreach ($files as $index => $file) {
				        $extension = $file->getClientOriginalExtension(); // getting image extension
				        $catFileName	= $this->generateRandomStringForImage($tableName,$fieldName);
				        $catFileName	= $catFileName.'.'.$extension;
				        $thumbName = 'thumb_'.$catFileName;
					 	// resizing an uploaded file
				        $destinationPath 	= 'uploads/products';
				        $destinationThumbPath 	= 'uploads/products/thumbs';
						Image::make($file)->resize(520, 350)->save($destinationThumbPath.'/'.$thumbName, 100);
						Image::make($file)->resize(900, 500)->save($destinationPath.'/'.$catFileName, 100);
				       // $file->move($destinationPath, $catFileName);
					$product_image = new ProductImages;
	                $product_image->product_id = $p_id;
	                $product_image->image = $catFileName;
	                $product_image->order = $index ;
	                $product_image->save();
				    }
		        }
		        // EO File Upload Code
		        return Redirect::route('edit_product', array($p_id));
         }
         return Redirect::back()->withInput();
	}

	public function edit($id)
	{
		$form_url   = 'admin/product/update/'.$id;
		$languages = Language::all();
		$category = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.cat_id', 'category_content.title')
		            ->orderBy('category_content.cat_id', 'asc')
		            ->groupBy('category_content.cat_id')
		            ->get();
		$p = Product::find($id);
		$product_content = DB::table('product_content')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
//                    ->join('product_info', 'product_info.product_id', '=', 'products.id')
		            ->join('languages', 'product_content.lang_id', '=', 'languages.id')
                    ->select('product_content.id as content_id',
                        'product_content.product_id',
                        'product_content.title',
                        'product_content.mini_description',
                        'product_content.description',
                        'languages.name',
                        'languages.code')
		            ->where('product_content.product_id', $id)
		            ->orderBy('product_content.product_id', 'asc')
		            ->get();
		$product_info = DB::table('product_info')
		            ->join('products', 'product_info.product_id', '=', 'products.id')
//                    ->join('product_info', 'product_info.product_id', '=', 'products.id')
		            ->join('languages', 'product_info.language_id', '=', 'languages.id')
                    ->select('product_info.*',
                        'languages.name',
                        'languages.code')
		            ->where('product_info.product_id', $id)
		            ->orderBy('product_info.product_id', 'asc')
		            ->get();

//        dd($product_content);
		$product_images = DB::table('product_images')
                    ->where('product_images.product_id', $id)
                    ->orderBy('product_images.order', 'asc')
                    ->get();

        $locations  = DB::table('location_content')
		            ->join('locations', 'location_content.loc_id', '=', 'locations.id')
		            ->select('location_content.loc_id','location_content.name')
		            ->where('locations.product_id', $id)
		            ->orderBy('location_content.loc_id', 'asc')
		            ->groupBy('location_content.loc_id')
		            ->get();

        //return $product_content;
        $product_content[0]=(array) $product_content[0];
        $product_content[1]=(array) $product_content[1];
        $product_info[0]=(array) $product_info[0];
        $product_info[1]=(array) $product_info[1];
        $product[0]=array_merge($product_content[0],$product_info[0]);
        $product[1]=array_merge($product_content[1],$product_info[1]);
        $i=0;
        foreach ($product as $pp)
        {
            $product[$i]= (object) $product[$i];
            $i++;
        }

        $providers= User::select('id','username','first_name','last_name')->where('type','provider')->get();
        $user_provider = User::where('id', $p->user_id)->first();

        return View::make('admin.edit_product', array(
            'form_url' => $form_url,
            'p' => $p,'locations' => $locations,
            'languages' => $languages, 'category' => $category,
            'products' => $product, 'product_images' => $product_images,
            'providers'=>$providers, 'user_provider'=>$user_provider
        ));

	}

	public function update($id)
	{
		$languages 	= Language::all();
        $cat_id  = Input::get('category');
        $product = Product::find($id);
        $product->type_of_payment = Input::get('type_of_payment');
        $product->cat_id = $cat_id;
        $product->user_id = Input::get('user_id');
        $product->state = Input::get('state');
        $product->first_loc_id = Input::get('first_loc_id');
        $product->tags = Input::get('tags');
        if(Input::has('to_whom')){
    	    $to_whom = Input::get('to_whom');
			$to_whom = implode(",",$to_whom);
        	$product->to_whom = $to_whom;
    	}
    	if(Input::has('special')){
    	    $special = Input::get('special');
			$special = implode(",",$special);
        	$product->special = $special;
    	}

        if ($product->save()) {
        	# code...
                $p_id = $product->id;
                $ps    =  DB::table('product_content')
                    ->where('product_content.product_id', $id)
                    ->orderBy('product_content.id', 'asc')
                    ->get();
                foreach ($ps as  $p) {
	                $product_content = ProductContent::find($p->id);
	                $product_content->title = Input::get('title')[$p->id];
	                $product_content->mini_description = Input::get('mini_description')[$p->id];
	                $product_content->description = Input::get('description')[$p->id];
	                $product_content->save();
	            }
            $product_info= ProductInfo::where('product_id',$product->id)->get();
            foreach ($product_info as $p) {
                    $product_info= ProductInfo::Find($p->id);
                    $product_info->includes= Input::get('includes')[$p->id];
                    $product_info->schedule_short= Input::get('schedule_short')[$p->id];
                    $product_info->duration= Input::get('duration')[$p->id];
                    $product_info->required= Input::get('required')[$p->id];
                    $product_info->terms_of_reservation= Input::get('terms_of_reservation')[$p->id];
                    $product_info->terms_of_cancellation= Input::get('terms_of_cancellation')[$p->id];
                    $product_info->restriction= Input::get('restriction')[$p->id];
                    $product_info->recommendation= Input::get('recommendation')[$p->id];
                    $product_info->not_include= Input::get('not_include')[$p->id];
                    $product_info->other_information= Input::get('other_information')[$p->id];
                    $product_info->validity= Input::get('validity')[$p->id];
                    $product_info->itinerary= Input::get('itinerary')[$p->id];
                    $product_info->department= Input::get('department')[$p->id];
                    $product_info->city= Input::get('city')[$p->id];
                    $product_info->street= Input::get('street')[$p->id];
                    $product_info->district= Input::get('district')[$p->id];
                    $product_info->price_with_tax= Input::get('price_with_tax')[$p->id];
                    $product_info->commission_previous= Input::get('commission_previous')[$p->id];
                    $product_info->final_commission_of_25= Input::get('final_commission_of_25')[$p->id];
                    $product_info->provider_price= Input::get('provider_price')[$p->id];
                    $product_info->save();
            }
				// BO File Upload Code
		    	$tableName 	= 'product_images';
		    	$fieldName 	= 'image';
		    	if(Input::hasFile('pimages')){
		    	   $files = Input::file('pimages');
		           foreach ($files as $index => $file) {
				        $extension = $file->getClientOriginalExtension(); // getting image extension
				        $catFileName	= $this->generateRandomStringForImage($tableName,$fieldName);
				        $catFileName	= $catFileName.'.'.$extension;
				        $thumbName = 'thumb_'.$catFileName;
					 	// resizing an uploaded file
				        $destinationPath 	= 'uploads/products';
				        $destinationThumbPath 	= 'uploads/products/thumbs';
						Image::make($file)->resize(520, 350)->save($destinationThumbPath.'/'.$thumbName, 100);
						Image::make($file)->resize(900, 500)->save($destinationPath.'/'.$catFileName, 100);
				       // $file->move($destinationPath, $catFileName);
                        $product_image = new ProductImages;
                        $product_image->product_id = $p_id;
                        $product_image->image = $catFileName;
                        $product_image->order = $index ;
                        $product_image->save();
				    }
		        }
		        // EO File Upload Code
		        return Redirect::route('list_products');
         }
         return Redirect::back()->withInput();
	}

	public function delete()
	{
		$product_id   	= Input::get('primery_id');
        $product 	   	= Product::find($product_id);
        if($product){
        	$product->state = '-1';
        	$product->save();
            return Redirect::to('admin/products')->with('msg','Product removed successfully');
        }
	}

	public function delete_image($id){
		$img =  DB::table('product_images')->where('id','=', $id)->pluck('image');
		$thumbName = 'thumb_'.$img;
        $destinationPath 	= 'uploads/products';
        $destinationThumbPath 	= 'uploads/products/thumbs';

		if(File::isFile($destinationPath.'/'.$img)){
            \File::delete($destinationPath.'/'.$img);
        }
        if(File::isFile($destinationPath.'/'.$thumbName)){
            \File::delete($destinationPath.'/'.$thumbName);
        }
        $image = ProductImages::find($id);
		$image->delete();
		return Redirect::back();
	}

    /**
     * @param $provider_id
     */
	public function product_per_provider($provider_id)
    {
        if(Auth::user()->type=='admin')
        {
            $products = DB::table('product_content')

                ->join('products', 'product_content.product_id', '=', 'products.id')
                ->join('categories', 'products.cat_id', '=', 'categories.id')
                ->join('category_content', 'category_content.cat_id', '=', 'categories.id')
                ->select('product_content.product_id', 'product_content.title','product_content.mini_description', 'category_content.title as cat_title' )
                ->where('products.state' , '!=', '-1')
                ->where('product_content.lang_id' , '=', langId())
                ->where('products.user_id' , '=', $provider_id)
                ->orderBy('product_content.product_id', 'asc')
                ->groupBy('product_content.product_id')
                ->get();
        }elseif(Auth::user()->type=='provider')
        {
            $products = DB::table('product_content')

                ->join('products', 'product_content.product_id', '=', 'products.id')
                ->join('categories', 'products.cat_id', '=', 'categories.id')
                ->join('category_content', 'category_content.cat_id', '=', 'categories.id')

                ->select('product_content.product_id', 'product_content.title','product_content.mini_description', 'category_content.title as cat_title' )
                ->where('products.state' , '!=', '-1')
                ->where('product_content.lang_id' , '=', langId())
                ->where('products.user_id' , '=', $provider_id)
                ->orderBy('product_content.product_id', 'asc')
                ->groupBy('product_content.product_id')
                ->get();
        }
        return View::make('admin.views.list_products_per_provider', array(
            'products' => $products, 'provider_id'=>$provider_id
        ));
    }

}

