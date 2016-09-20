<?php

class FaqController extends \BaseController {

	
	public function index()
	{
		$faqs = DB::table('faqs')
		            ->join('faqcontents', 'faqs.id', '=', 'faqcontents.faq_id')
		            ->join('languages', 'languages.id', '=', 'faqcontents.lang_id')
		            ->select('faqs.state', 'faqcontents.faq_id','faqcontents.que','faqcontents.ans', 'languages.name')
	                ->where('faqs.product_id', '=', null)
	                ->where('languages.code', '=', 'en')
		            ->orderBy('faqcontents.id', 'asc')
	                ->groupBy('faqcontents.faq_id')
		            ->get();

        return View::make('admin.faqs', array('faqs' => $faqs));
	}


	
	public function add()
	{	
		$languages = Language::all();
        return View::make('admin.add_faq', array('languages' => $languages));
	}


	
	public function save()
	{
		$languages = Language::all();
        $faq = new Faq;
        $faq->state = '1';
        if($faq->save()){
        	$date = date('Y-m-d H:i:s');
	        foreach ($languages as  $language) {
	        	DB::table('faqcontents')->insert(
	                    array(
	                        'faq_id' => $faq->id,
	                        'lang_id' => $language->id,
	                        'que' => Input::get('que')[$language->code],
	                        'ans' => Input::get('ans')[$language->code],
	                        'created_at'  => $date,
	                        'updated_at'  => $date
	                    )
	                );
	        }
    	}
        return Redirect::route('list_faqs');
	}


	
	public function edit($id)
    {
        $faq_id = $id;
        
        $data = DB::table('faqs')
                    ->join('faqcontents', 'faqs.id', '=', 'faqcontents.faq_id')
                    ->join('languages', 'languages.id', '=', 'faqcontents.lang_id')
                    ->select('faqs.state', 'faqcontents.id','faqcontents.faq_id','faqcontents.que','faqcontents.ans', 'languages.name')
                    ->where('faqs.id', $faq_id)
                    ->orderBy('faqcontents.id', 'asc')
                    ->get();

        return View::make('admin.edit_faq', array( 'content' => $data, 'faq_id' => $faq_id));
    }

    public function update($id)
    {
        $faqcontents    =  DB::table('faqcontents')
                    
                    ->where('faqcontents.faq_id', $id)
                    ->orderBy('faqcontents.id', 'asc')
                    ->get();
        
        foreach ($faqcontents as $index => $content) {
           	$faq = Faqcontent::find($content->id);
            $faq->que = Input::get('que')[$content->id];
            $faq->ans = Input::get('ans')[$content->id];
            $faq->save();
        }
        return Redirect::route('list_faqs');
        
    }

    public function delete(){
        $faq_id        = Input::get('primery_id');
        $faq           = Faq::find($faq_id);

        if($faq){
            $faq->delete();
            return Redirect::to('admin/faqs')->with('msg','FAQ removed successfully');
        }

    }


    // Product Faq's
    public function efaqindex($id)
	{
		$languages = Language::all();
		$faqs  = DB::table('faqcontents')
	            ->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
	            ->select('faqcontents.id','faqcontents.faq_id','faqcontents.que', 'faqcontents.ans','faqs.product_id')
	            ->where('faqs.product_id', $id)
	            ->orderBy('faqcontents.faq_id', 'asc')
	            ->groupBy('faqcontents.faq_id')
	            ->get();
		
		return View::make('admin.list_efaqs', array('product_id' => $id,'languages' => $languages, 'faqs' => $faqs));
	}

	public function efaqsave(){

		$languages = Language::all();
        $faq = new Faq;
        $faq->product_id = Input::get('product_id');
        $faq->state = '1';
        if($faq->save()){
	        foreach ($languages as  $language) {
	        	$que = Input::get('que')[$language->code];
	        	$ans = Input::get('ans')[$language->code];
	        	$faq_content = new Faqcontent;
	        	$faq_content->faq_id = $faq->id;
        		
	        	$faq_content->lang_id = $language->id;
	        	$faq_content->que = $que;
	        	$faq_content->ans = $ans;
	        	$faq_content->save();
	        	
	        }
    	}
       // return Redirect::route('list_faqs', array(Input::get('product_id')));
		return 'success';
	}
	public function efaqedit($pid, $id)
	{
		//$languages = Language::all();
		$faq_id = Faq::find($id);
		//return $loc;
		$faq  = DB::table('faqcontents')
		            ->join('faqs', 'faqcontents.faq_id', '=', 'faqs.id')
		            ->join('languages', 'faqcontents.lang_id', '=', 'languages.id')
		            ->select('faqcontents.id','faqcontents.faq_id','faqcontents.lang_id','faqcontents.que', 'faqs.product_id', 'faqcontents.ans','languages.code', 'languages.name as lang_name')
		            ->where('faqs.id', $id)
		            ->orderBy('faqcontents.faq_id', 'asc')
		            ->get();
		// return $faq;
        return View::make('admin.edit_efaq', array('loc' => $faq_id, 'faqs' => $faq));
	}

	public function efaqupdate(){

		$product_id = Input::get('product_id');
		$faq_id = Input::get('faq_id');
		$languages = Language::all();
        $faq = Faq::find($faq_id);
        if($faq->save()){
        	
                $faqs  =  DB::table('faqcontents')
                    ->where('faqcontents.faq_id', $faq_id)
                    ->orderBy('faqcontents.id', 'asc')
                    ->get();

	        foreach ($faqs as  $faq) {
	        	$que = Input::get('que')[$faq->id];
	        	$ans = Input::get('ans')[$faq->id];
	        	$faq_content = Faqcontent::find($faq->id);
	        	$faq_content->que = $que;
	        	$faq_content->ans = $ans;
	        	$faq_content->save();
	        	
	        }
    	}
		return 'success';
	}

	public function efaqdelete()
	{

		$faq_id        	= Input::get('primery_id');
        $faq 	   		= Faq::find($faq_id);
        $product_id 	= $faq->product_id;

        //return $location;
        if($faq){
            $faq->delete();
            return Redirect::to('admin/'.$product_id.'/efaqs')->with('msg','FAQ removed successfully');
        }
	}

}
