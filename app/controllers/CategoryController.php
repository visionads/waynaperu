<?php

class CategoryController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
        $categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.orders', 'category_content.title', 'category_content.description')
		            ->orderBy('category_content.id', 'asc')
		            ->groupBy('category_content.cat_id')
		            ->get();
		// return $categories;
        //return View::make('admin.list_categories', array('categories' => $categories));
        return View::make('admin.list_categories')->with('categories',$categories);
	}


	public function add()
	{
		 $form_url   = 'admin/category/save';
		 $languages = Language::all();

        // return View::make('admin.add_language')->with('form_url', $form_url);
		 return View::make('admin.add_category', array('form_url' => $form_url, 'languages' => $languages));
	}


	public function save()
	{
		// return Input::all();

		$languages 	= Language::all();
		// BO File Upload Code	
    	$tableName 	= 'categories';	
    	$fieldName 	= 'image';

    	if(Input::hasFile('image')){

	        $destinationPath 	= 'uploads/categories';
	        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        $catFileName	= $this->generateRandomStringForImage($tableName,$fieldName);
	        $catFileName	= $catFileName.'.'.$extension;
	        Image::make(Input::file('image'))->resize(400, 160)->save($destinationPath.'/'.$catFileName, 100);
	        //Input::file('image')->move($destinationPath, $catFileName);

        }else{

            $catFileName = '';
        }
        $iconfieldName 	= 'icon';
        if(Input::hasFile('icon')){

	        $destinationPath 	= 'uploads/categories';
	        $iconextension = Input::file('icon')->getClientOriginalExtension(); // getting image extension
	        $catIconFileName	= $this->generateRandomStringForImage($tableName,$iconfieldName);
	        $catIconFileName	= 'icon_'.$catIconFileName.'.'.$iconextension;
	        Input::file('icon')->move($destinationPath, $catIconFileName);

        }else{

            $catIconFileName = '';
        }

        $proiconfieldName 	= 'proicon';
        if(Input::hasFile('proicon')){

	        $destinationPath 	= 'uploads/categories';
	        $proiconextension = Input::file('proicon')->getClientOriginalExtension(); // getting image extension
	        $proIconFileName	= $this->generateRandomStringForImage($tableName,$proiconfieldName);
	        $proIconFileName	= 'proicon_'.$proIconFileName.'.'.$proiconextension;
	        Input::file('proicon')->move($destinationPath, $proIconFileName);

        }else{

            $proIconFileName = '';
        }

        // EO File Upload Code

        $category 	= new Category;
 		$category->image   = $catFileName;
 		$category->icon    = $catIconFileName;
 		$category->proicon = $proIconFileName;
        $category->state 	= '1';
        $category->orders    = Input::get('orders');
        if($category->save()){

        	

        	$date = date('Y-m-d H:i:s');
	        foreach ($languages as  $language) {
	        	DB::table('category_content')->insert(
	                    array(
	                        'cat_id' => $category->id,
	                        'lang_id' => $language->id,
	                        'title' => Input::get('title')[$language->code],
	                        'description' => Input::get('description')[$language->code],
	                        'created_at'  => $date,
	                        'updated_at'  => $date
	                    )
	                );
	        }
    	}

        return Redirect::to('admin/categories')->with('msg','Category added successfully');
	}


	public function edit($id)
	{
		$form_url   = 'admin/category/update/'.$id;
		 $languages = Language::all();
		 $c = Category::find($id);
		 $category = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->join('languages', 'category_content.lang_id', '=', 'languages.id')
		            ->select('category_content.id', 'category_content.cat_id', 'category_content.title', 'category_content.description', 'categories.image','categories.icon', 'categories.proicon', 'categories.state', 'languages.name', 'languages.code')
		            ->where('category_content.cat_id', $id)
		            ->orderBy('category_content.cat_id', 'asc')
		            ->get();

        // return View::make('admin.add_language')->with('form_url', $form_url);
		 return View::make('admin.edit_category', array('form_url' => $form_url, 'c'=>$c, 'languages' => $languages, 'category'=>$category));
	}


	public function update($id)
	{
		// return Input::all();

		$languages 	= Language::all();
		// BO File Upload Code	
    	$tableName 	= 'categories';	
    	$fieldName 	= 'image';

    	if(Input::hasFile('image')){

	        $destinationPath 	= 'uploads/categories';
	        $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        $catFileName	= $this->generateRandomStringForImage($tableName,$fieldName);
	        $catFileName	= $catFileName.'.'.$extension;
	        Image::make(Input::file('image'))->resize(400, 160)->save($destinationPath.'/'.$catFileName, 100);
	        //Input::file('image')->move($destinationPath, $catFileName);

        }

        $iconfieldName 	= 'icon';

    	if(Input::hasFile('icon')){

	        $destinationPath 	= 'uploads/categories';
	        $iconextension = Input::file('icon')->getClientOriginalExtension(); // getting image extension
	        $caticonFileName	= $this->generateRandomStringForImage($tableName,$iconfieldName);
	        $caticonFileName	= 'icon_'.$caticonFileName.'.'.$iconextension;
	        Input::file('icon')->move($destinationPath, $caticonFileName);

        }

         $proiconfieldName 	= 'proicon';

    	if(Input::hasFile('proicon')){

	        $destinationPath 	= 'uploads/categories';
	        $proiconextension = Input::file('proicon')->getClientOriginalExtension(); // getting image extension
	        $proiconFileName	= $this->generateRandomStringForImage($tableName,$proiconfieldName);
	        $proiconFileName	= 'proicon_'.$proiconFileName.'.'.$proiconextension;
	        Input::file('proicon')->move($destinationPath, $proiconFileName);

        }
        // EO File Upload Code

        $category 	= Category::find($id);
        if(Input::hasFile('image')){
 			$category->image    = $catFileName;
 		}
 		if(Input::hasFile('icon')){
 			$category->icon    = $caticonFileName;
 		}
 		if(Input::hasFile('proicon')){
 			$category->proicon    = $proiconFileName;
 		}
        $category->state 	= '1';
        $category->orders    = Input::get('orders');
        
        if($category->save()){

        	# code...
                $c_id = $category->id;
                $ps    =  DB::table('category_content')
                    ->where('category_content.cat_id', $id)
                    ->orderBy('category_content.id', 'asc')
                    ->get();
                foreach ($ps as  $p) {
	                $category_content = IndCategory::find($p->id);
	                $category_content->title = Input::get('title')[$p->id];
	                $category_content->description = Input::get('description')[$p->id];
	                $category_content->save();
	            }


        	
    	}

        return Redirect::to('admin/categories')->with('msg','Category added successfully');
	}


	public function delete()
	{
		$cat_id        = Input::get('primery_id');
        $categories           = Category::find($cat_id);

        if($categories){
            $categories->delete();
            return Redirect::to('admin/categories')->with('msg','category removed successfully');
        }
	}


	
}
