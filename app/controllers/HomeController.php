<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
	private  $url_language_id;
    public function __construct()
    {
        
            $lang_code = LaravelLocalization::getCurrentLocale();
            $this->url_language_id    = getLangId($lang_code);
       
    }

	public function showWelcome()
	{

		//$profit = (20.1*100)/100;
		//dd($profit);
        $sliders= Slider::where('status','active')->orderBy('sequence')->get();
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
		$products = DB::table('product_content')
		            ->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1')
		            ->where('product_content.title', '!=', '')
		            ->where('category_content.title', '!=', '')
		            ->groupBy('product_images.product_id')
		            ->take(18)
		            //->orderBy(DB::raw('RAND()'))
		            ->get();
		$how_wayna_work = DB::table('contents')
		            ->where('contents.lang_id', $this->url_language_id)
		            ->where('contents.page_id', 1)
		            ->first();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		//return Cart::content();

		return View::make('front.home')
		->with('categories',$categories)
		->with('products',$products)
		->with('districts',$districts)
		->with('tags',$tags)
		->with('sliders',$sliders)
		->with('how_wayna_work',$how_wayna_work);
	}

	public function showCategory($name, $id)
	{
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
		$cat = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('categories.id', $id)
		            ->first();
		$products = DB::table('product_content')
		            ->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.cat_id', $id)
		            ->where('products.state', '1')
                    ->where('product_content.title', '!=', '')
                    ->where('category_content.title', '!=', '')
		            ->groupBy('product_images.product_id')
		            ->orderBy(DB::raw('RAND()'))
		            ->get();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		//return $products;
		return View::make('front.category')
		->with('categories',$categories)
		->with('cat',$cat)
		->with('districts',$districts)
		->with('tags',$tags)
		->with('products',$products);
	}

	public function showSearch()
	{
		$q = Input::get('q');
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
		$products = DB::table('product_content')
					->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
					->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', '=', $this->url_language_id)
		            ->where('products.state', '1')
                    ->where('product_content.title', '!=', '')
                    ->where('category_content.title', '!=', '')
		            //->where('product_content.title', 'LIKE', $q.'%')
		            ->where(function($query) use ($q)
			            {
			                $query ->orWhere('products.tags', 'LIKE', '%'.$q.'%');
		            				//->orWhere('products.to_whom', 'LIKE', '%'.$q.'%');
			            })
		           
		            ->orderBy('product_content.product_id', 'asc')
		            ->groupBy('product_images.product_id')
		            ->get();

		$popular_products = DB::table('product_content')
					->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            //->select('products.id','product_content.title')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1')
		            ->groupBy('product_images.product_id')
		            ->orderBy('products.hits', 'desc')
		            ->take(9)
		            ->get();

        //$popular_products = [];

		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		//return $products;
		return View::make('front.search')
		->with('categories',$categories)
		->with('products',$products)
		->with('popular_products',$popular_products)
		->with('tags',$tags)
		->with('districts',$districts);
	}

	public function showSpecial($special)
	{
		$q = $special;
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
		$products = DB::table('product_content')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1')
		            ->where('products.special', 'LIKE', '%'.$q.'%')
		            ->orderBy('product_content.product_id', 'asc')
		            ->groupBy('product_images.product_id')
		            ->get();
		$popular_products = DB::table('product_content')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->select('products.id','product_content.title')
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1')
		            ->groupBy('product_images.product_id')
		            ->orderBy('products.hits', 'desc')
		            ->take(9)
		            ->get();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		//return $products;
		return View::make('front.special')
		->with('categories',$categories)
		->with('products',$products)
		->with('popular_products',$popular_products)
		->with('tags',$tags)
		->with('districts',$districts);
	}

	public function showAutoSearch()
	{
		$q = Input::get('q');
		
		$products = DB::table('product_content')
                    ->select('product_content.*', 'product_images.*')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'category_content.cat_id', '=', 'categories.id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1')
		            ->where('product_content.title', '!=', '')
		            ->where('category_content.title', '!=', '')
		            ->where('product_content.title', 'LIKE', $q.'%')
		            ->where(function($query) use ($q)
			            {
			                $query ->orWhere('products.tags', 'LIKE', '%'.$q.'%')
		            				->orWhere('products.to_whom', 'LIKE', '%'.$q.'%');
			            })
		            ->orderBy('product_content.product_id', 'asc')
		            ->groupBy('product_content.product_id')
		            ->get();
		$productHTML = '';
		foreach ($products as $key => $value) {
			$title='<span class="auto-q">'.$q.'</span>';
			$final_title = preg_replace('/\b'.$q.'\b/i', $title, $value->title, 1);
			$productHTML .='<div class="show" align="left"><img src="'.asset('uploads/products/'.$value->image) .'" alt="blog" width="50px"><span class="name">'.$final_title.'</span></div>';
		}
		return $productHTML;
	}

	public function showFilter()
	{
		$q = Input::get('q');
		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
		$query = DB::table('product_content')
		 			->select('*', 'product_content.title as product_title', 'category_content.title as category_name')
		            ->join('products', 'product_content.product_id', '=', 'products.id')
		            ->join('categories', 'products.cat_id', '=', 'categories.id')
		            ->join('category_content', 'categories.id', '=', 'category_content.cat_id')
		            ->join('locations', 'locations.product_id', '=', 'products.id')
		            ->join('product_images', 'product_images.product_id', '=', 'products.id')
		            ->where('product_content.lang_id', $this->url_language_id)
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->where('products.state', '1');
		            if(Input::has('category')){
		            	$query->where('products.cat_id',Input::get('category'));
		        	}
		        	if(Input::has('tag')){
		            	$query->where('products.to_whom', 'LIKE', '%'.Input::get('tag').'%');
		        	}
		        	if(Input::has('min-price')){
		        		$query-> where('locations.price1','>=',Input::get('min-price'));
		        	}
		        	if(Input::has('max-price')){
		        		if(Input::get('max-price') != 'above'){
							$query-> where('locations.price1','<=',Input::get('max-price'));
						}
					}
					if(Input::has('disttid')){
						$query-> where('locations.district_id',Input::get('disttid'));
					}
		            $query->orderBy('product_content.product_id', 'asc');
		            $query->groupBy('locations.product_id');
		$products=  $query->get();
		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));
		//return $products;
		return View::make('front.filter')
		->with('categories',$categories)
		->with('products',$products)
		->with('tags',$tags)
		->with('districts',$districts);
	}

	public function termsConditions()
    {
        $page_id	= 4;
		$content 	= DB::table('contents')
		            ->select('contents.title', 'contents.description')
		            ->where('contents.lang_id', $this->url_language_id)
		            ->where('contents.page_id', $page_id)
		            ->first();

        $categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();

        $districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));

        return View::make('front.page')
        ->with('categories',$categories)
        ->with('content',$content)
        ->with('tags',$tags)
		->with('districts',$districts);
    }
	public function bookOfReclaims()
	{
		$page_id	= 4;
		$content 	= DB::table('contents')
			->select('contents.title', 'contents.description')
			->where('contents.lang_id', $this->url_language_id)
			->where('contents.page_id', $page_id)
			->first();

		$categories = DB::table('category_content')
			->join('categories', 'category_content.cat_id', '=', 'categories.id')
			->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
			->where('category_content.lang_id', $this->url_language_id)
			->orderBy('category_content.id', 'asc')
			->get();

		$districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
			->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
			->get();
		$tags = array_unique(explode(",",$tags[0]->tags));

		return View::make('front.book_of_reclaims')
			->with('categories',$categories)
			->with('content',$content)
			->with('tags',$tags)
			->with('districts',$districts);
//		return View::make('front.bookofreclaims');
	}
	public function wayna_work()
    {
        $page_id	= 5;
		$content 	= DB::table('contents')
		            ->select('contents.title', 'contents.description')
		            ->where('contents.lang_id', $this->url_language_id)
		            ->where('contents.page_id', $page_id)
		            ->first();

        $categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();

        $districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));

        return View::make('front.wayna')
        ->with('categories',$categories)
        ->with('content',$content)
        ->with('tags',$tags)
		->with('districts',$districts);
    }

	public function removeRow()
	{
		$rowId =Input::get('row_id');
		Cart::remove($rowId);
		$CartHTML = '';
		foreach (Cart::content() as $cart) {
			$CartHTML .='<li><span class="item"><span class="item-left">';
			$CartHTML .='<img src="'. asset('uploads/products/thumbs/thumb_'.getLocImage($cart->options['loc_id'])). '" alt="" width="50px" height="50px"/>';
            $CartHTML .='<span class="item-info"><span>'.$cart->name .'</span><span>S/. '. $cart->price .'</span>';
            $CartHTML .='</span></span><span class="item-right"><button class="btn btn-xs btn-danger pull-right" onclick="removeRow('.$cart->rowid .')">x</button></span></span></li>';
		}
		$CartHTML .='<li class="divider"></li><li><a class="text-center" href="'. route('cart') .'">View Cart</a></li>';
		//return Response::json(array('html' => $CartHTML, 'count' => Cart::count(false)));
		return Response::json(array('success' => '1'));
	}

	public function faq()
	{

		$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();

        $districts = District::orderBy('name', 'ASC')->get();
		$tags = DB::table('products')
					    ->select(DB::raw('GROUP_CONCAT(DISTINCT tags) as  tags'))
					    ->get();
		$tags = array_unique(explode(",",$tags[0]->tags));

        return View::make('front.faq')
        ->with('categories',$categories)
        ->with('tags',$tags)
		->with('districts',$districts);
	}





}
