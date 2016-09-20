<?php

class DistrictsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
        $districts = District::all();
		// return $categories;
        //return View::make('admin.list_categories', array('categories' => $categories));
        return View::make('admin.list_districts')->with('districts',$districts);
	}


	public function add()
	{
		 $form_url   = 'admin/district/save';
		
		 return View::make('admin.add_district', array('form_url' => $form_url));
	}


	public function save()
	{
		

        $district 	= new District;
 		$district->name    = Input::get('name');
        $district->save();


        return Redirect::to('admin/districts')->with('msg','District added successfully');
	}


	public function edit($id)
	{
			$form_url   = 'admin/district/update/'.$id;
		 
		 $district = District::find($id);
		 
		 return View::make('admin.edit_district', array('form_url' => $form_url, 'district'=>$district));
	}


	public function update($id)
	{
		

        $district 	= District::find($id);
        
        $district->name    = Input::get('name');
        $district->save();



        return Redirect::to('admin/districts')->with('msg','District added successfully');
	}


	public function delete()
	{
		$district_id        = Input::get('primery_id');
        $district           = District::find($district_id);

        if($district){
            $district->delete();
            return Redirect::to('admin/districts')->with('msg','District removed successfully');
        }
	}


	
}
