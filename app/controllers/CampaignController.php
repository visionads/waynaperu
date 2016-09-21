<?php 

class CampaignController extends BaseController {

	public function index()
	{
		return View::make('front.campaign.form');
	}

	public function store()
	{
		$response = ['status' => 'failed'];
		try {
			$rules = array(
				'names' => 'required|string',
		        'surname_father' => 'required|string',
		        'surname_mother' => 'required|string',
		        'dni' => 'required|numeric',
		        'email' => 'required|email',
	        );

			$validator = Validator::make(Input::all(), $rules);
			if ( $validator->fails() ) {
		        throw new Exception("Verifique que los datos enviados sean los correctos.", 1);
		    }

			$row = Campaign::where('email', '=', Input::get('email'))
			               ->orWhere('dni', '=', Input::get('dni'))->first();

		    if ( !is_null($row) ) {
		        throw new Exception("Lo sentimos, solo puedes participar una vez.", 1);		    	
		    }

		    $campaign = new Campaign;
		    $campaign->names = Input::get('names');
		    $campaign->surname_father = Input::get('surname_father');
		    $campaign->surname_mother = Input::get('surname_mother');
		    $campaign->dni = Input::get('dni');
		    $campaign->email = Input::get('email');
		    $campaign->source = Input::get('source');
		    $campaign->save();

		    $response = ['status' => 'success'];
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
			$response['errors'] = $validator->messages();
		}

		return Response::json($response);
	}

	public function single()
	{
		$response = ['status' => 'failed'];
		try {
			$rules = array(
				'names' => 'required|string',
		        'surname_father' => 'required|string',
		        'surname_mother' => 'required|string',
		        'dni' => 'required|numeric',
		        'email' => 'required|email',
	        );

			$validator = Validator::make(Input::all(), $rules);
			if ( $validator->fails() ) {
		        throw new Exception("Verifique que los datos enviados sean los correctos.", 1);
		    }

			$row = Campaign::where('email', '=', Input::get('email'))
			               ->orWhere('dni', '=', Input::get('dni'))->first();

		    if ( !is_null($row) ) {
		        throw new Exception("Lo sentimos, solo puedes participar una vez.", 1);		    	
		    }

		    $campaign = new Campaign;
		    $campaign->names = Input::get('names');
		    $campaign->surname_father = Input::get('surname_father');
		    $campaign->surname_mother = Input::get('surname_mother');
		    $campaign->dni = Input::get('dni');
		    $campaign->email = Input::get('email');
		    $campaign->source = Input::get('source');
		    $campaign->save();

		    $response = ['status' => 'success'];

			return Redirect::to('campaigns/mothers-of-day-thanks');
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
			$response['errors'] = $validator->messages();
		}

		return Redirect::back()->withStatus('failed')->withErrors($validator);

	}

	public function thanks() 
	{
		return View::make('front.campaign.typ');
	}

	public function newsletter()
	{
		$response = ['status' => 'failed'];
		try {
			$rules = array(
				'names' => 'required|string',
		        'email' => 'required|email',
		        'sexo' => 'required|numeric',
	        );

			$validator = Validator::make(Input::all(), $rules);
			if ( $validator->fails() ) {
		        throw new Exception("Verifique que los datos enviados sean los correctos.", 1);
		    }

			$row = Campaign::where('email', '=', Input::get('email'))->first();

		    if ( is_null($row) ) {
			    $campaign = new Campaign;
			    $campaign->names = Input::get('names');
			    $campaign->email = Input::get('email');
			    $campaign->sexo = Input::get('sexo');
			    $campaign->source = Input::get('source');
			    $campaign->save();
		    }

		    $response = ['status' => 'success'];
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
			$response['errors'] = $validator->messages();
		}

		return Response::json($response);
	}

}
