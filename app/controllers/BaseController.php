<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function generateRandomStringForImage($tableName,$fieldName){

	    $newImage_name = str_random(12);

	    $count = DB::table($tableName)->count();

	    if($count){

		$i = 0;
		$count = count($fieldName);

		if(is_array($fieldName)){

			while($count > 0){
				$search = DB::table($tableName)->where($fieldName[$i], '=',$newImage_name)->get();
				$count--;
				$i++;
			}

			while($search){

			    $newImage_name = str_random(12);
			    $search = DB::table($tableName)->where($fieldName, '=',$newImage_name)->get();

			}
			return $newImage_name;

		}else{


			$search = DB::table($tableName)->where($fieldName, '=',$newImage_name)->get();

			while($search){

			    $newImage_name = str_random(12);
			    $search = DB::table($tableName)->where($fieldName, '=',$newImage_name)->get();

			}
			return $newImage_name;
		}

	    }

	    return $newImage_name;
	}

}
