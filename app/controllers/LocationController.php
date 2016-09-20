<?php

class LocationController extends BaseController {

	public function index($id)
	{
		$languages = Language::all();
		$locations  = DB::table('location_content')
		            ->join('locations', 'location_content.loc_id', '=', 'locations.id')
		            ->select('location_content.id','location_content.loc_id','location_content.name', 'location_content.details', 'locations.price1','locations.price2','locations.price3', 'locations.order','locations.product_id', 'locations.product_image_id')
		            ->where('locations.product_id', $id)
		            ->orderBy('location_content.loc_id', 'asc')
		            ->groupBy('location_content.loc_id')
		            ->get();
		$product_images = DB::table('product_images')
                    
                    ->where('product_images.product_id', $id)
                    ->orderBy('product_images.order', 'asc')
                    ->get();
        $districts = District::all();
		return View::make('admin.list_locations', array('districts' => $districts,'product_id' => $id,'languages' => $languages, 'locations' => $locations, 'product_images' => $product_images));
	}

	public function save(){

		//$price = array('pdf' => Input::get('pdf'), 'mail' => Input::get('mail'), 'gift' => Input::get('gift') );
		//$price = json_encode($price);
		$languages = Language::all();
        $location = new Location;
        $location->product_id = Input::get('product_id');
        $location->price1 = Input::get('pdf');
        $location->price2 = Input::get('mail');
        $location->price3 = Input::get('gift');
        $location->district_id = Input::get('district_id');
        $location->order = '1';
        $location->product_image_id = Input::get('product_image_id');
        if($location->save()){
        	
	        foreach ($languages as  $language) {
	        	$name = Input::get('name')[$language->code];
	        	$details = array();
	        	$details_cat = Input::get('details_cat')[$language->code];
	        	$details_val = Input::get('details_val')[$language->code];
	        	for ($i=0; $i < count($details_cat); $i++) { 
	        		$details = array_add($details, $details_cat[$i], $details_val[$i]);
	        	}
	        	$details = json_encode($details);
	        	$location_content = new LocationContent;
	        	$location_content->loc_id = $location->id;
	        	$location_content->lang_id = $language->id;
	        	$location_content->name = $name;
	        	$location_content->details = $details;
	        	$location_content->save();
	        	
	        }
    	}
       // return Redirect::route('list_locations', array(Input::get('product_id')));
		return 'success';
	}
	public function edit($pid, $id)
	{
		//$languages = Language::all();
		$loc = Location::find($id);
		//return $loc;
		$location  = DB::table('location_content')
		            ->join('locations', 'location_content.loc_id', '=', 'locations.id')
		            ->join('languages', 'location_content.lang_id', '=', 'languages.id')
		            ->select('location_content.id','location_content.loc_id','location_content.lang_id','location_content.name', 'location_content.details', 'locations.price1','locations.price2','locations.price3','locations.district_id', 'locations.order','locations.product_id', 'locations.product_image_id','languages.code', 'languages.name as lang_name')
		            ->where('locations.id', $id)
		            ->orderBy('location_content.loc_id', 'asc')
		            ->get();
		$product_images = DB::table('product_images')
                    
                    ->where('product_images.product_id', $pid)
                    ->orderBy('product_images.order', 'asc')
                    ->get();
        $districts = District::all();
        //return $location;
        return View::make('admin.edit_location', array('districts' => $districts,'loc' => $loc, 'locations' => $location, 'product_images' => $product_images));
	}

	public function update(){

		$product_id = Input::get('product_id');
		$location_id = Input::get('location_id');
		//$price = array('pdf' => Input::get('pdf'), 'mail' => Input::get('mail'), 'gift' => Input::get('gift') );
		//$price = json_encode($price);
		$languages = Language::all();
        $location = Location::find($location_id);
        $location->product_id = Input::get('product_id');
        $location->price1 = Input::get('pdf');
        $location->price2 = Input::get('mail');
        $location->price3 = Input::get('gift');
        $location->district_id = Input::get('district_id');
        $location->order = '1';
        $location->product_image_id = Input::get('product_image_id');
        if($location->save()){
        	
                $locations  =  DB::table('location_content')
                    ->where('location_content.loc_id', $location_id)
                    ->orderBy('location_content.id', 'asc')
                    ->get();

	        foreach ($locations as  $location) {
	        	$name = Input::get('name')[$location->id];
	        	$details = array();
	        	$details_cat = Input::get('details_cat')[$location->id];
	        	$details_val = Input::get('details_val')[$location->id];
	        	for ($i=0; $i < count($details_cat); $i++) { 
	        		$details = array_add($details, $details_cat[$i], $details_val[$i]);
	        	}
	        	$details = json_encode($details);
	        	$location_content = LocationContent::find($location->id);
	        	$location_content->name = $name;
	        	$location_content->details = $details;
	        	$location_content->save();
	        	
	        }
    	}
       // return Redirect::route('list_locations', array(Input::get('product_id')));
		return 'success';
	}

	public function delete()
	{

		$loc_id        	= Input::get('primery_id');
        $location 	   	= Location::find($loc_id);
        $product_id 	= $location->product_id;

        //return $location;
        if($location){
            $location->delete();
            return Redirect::to('admin/'.$product_id.'/locations')->with('msg','Location removed successfully');
        }
	}
}

