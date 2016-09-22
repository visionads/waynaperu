<?php
use Vrigzalejo\Usermanager\Controllers\UserController;
use Vrigzalejo\Usermanager\Services\Validators\User as UserValidator;
class UsersController extends UserController {
	private  $url_language_id;
    public function __construct()
    {

            $lang_code = LaravelLocalization::getCurrentLocale();
            $this->url_language_id    = getLangId($lang_code);
       
    }
	public function postLogin(){
		if (Auth::check())
		{
    		return Redirect::route('home');
    	}else{
			$email = Input::get('login-email');
			$password = Input::get('login-password');
			$rules = array(
				        'login-email' => 'required|email',
				        'login-password'  => 'required|min:6',
				    );
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
			{
			   return Redirect::to('?error=1')->withInput()->withErrors($validator);
			}
			
			if(Auth::attempt(array('email' => $email, 'password' => $password))){
				return Redirect::route('home');
			}else{
				 return Redirect::to('?error=2')->withInput();
			}
		}
	}
	public function postRegister(){
		$rules = array(
					'username' => 'required|min:3|unique:users',
			        'email' => 'required|email|unique:users',
			        'email1' => 'required|email|same:email',
			        'pass'  => 'required|min:6',
			        'g-recaptcha-response' => 'required|recaptcha',
			    );
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
		   return Redirect::to('?error=1')->withInput()->withErrors($validator);
		}
		$register = $this->postCreate();
		//return $register;
		$register = json_decode($register);

		if(!$register->userCreated){
			 return Redirect::to('?error=2')->withInput();
		}else{
			return Redirect::to('?activation=1');
		}
		
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('home');
	}
	public function getAccount(){
		if(Auth::check()){
			$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
			
			$districts = District::all();
			//return $products;
			return View::make('front.account')
			->with('categories',$categories)
			->with('districts',$districts);
			
		}else{
			return Redirect::route('home');
		}
	}
	public function postAccount(){
		if(Auth::check()){
			$categories = DB::table('category_content')
		            ->join('categories', 'category_content.cat_id', '=', 'categories.id')
		            ->select('category_content.id','category_content.cat_id', 'categories.state', 'categories.image','categories.icon', 'category_content.title', 'category_content.description')
		            ->where('category_content.lang_id', $this->url_language_id)
		            ->orderBy('category_content.id', 'asc')
		            ->get();
			
			$districts = District::all();

			$rules = array(
				    'first_name' => 'required|min:3',
				    'last_name' => 'required|min:3',
			        'email' => 'required|email',
			        'dob' => 'date',
			        'old_pass' => 'required_with:new_pass',
			        'new_pass'  => 'required_with:old_pass|different:old_pass',
			        'confirm_new_pass'  => 'required_with:old_pass|different:old_pass|same:new_pass',
			    );
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
			{
				//return $validator->messages();
				return View::make('front.account')
				->with('categories',$categories)
				->with('districts',$districts)
				->with('errors',$validator->messages());
			}else{
				$hashedPassword = DB::table('users')->where('id', '=', Auth::id())->pluck('password');
				$user = User::find(Auth::id());
				$user->first_name = (string)Input::get('first_name');
				$user->last_name = (string)Input::get('last_name');
				$user->email = Input::get('email');
				$user->dob = Input::get('dob');
				$user->passport = Input::get('passport');
				$user->direction = Input::get('direction');
				$user->flat = Input::get('flat');
				$user->city = Input::get('city');
				$user->district = Input::get('district');
				$user->province = Input::get('province');
				$user->dep = Input::get('dep');
				if (Hash::check(Input::get('old_pass'), $hashedPassword)){
					$user->password = Hash::make(Input::get('new_pass'));
				}
				$user->save();
				return Redirect::route('account');
			}
			
			
		}else{
			return Redirect::route('home');
		}
	}

}