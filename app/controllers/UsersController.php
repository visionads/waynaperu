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
	public function admin_login(){
        if (Auth::check())
        {
            return Redirect::route('admin');
        }else{
            return View::make('admin.login');
        }
    }
    public function admin_login_check()
    {
        if (!Auth::check())
        {
            $auth=UsersController::authCheck();
            if($auth==false)
            {
                return Redirect::route('admin-login');
            }else{
                if($auth->type=='admin')
                {
                    UsersController::newUserActivity('admin-login','admin_login','login','users');
                    return Redirect::route('admin');
                }else{
                    UsersController::newUserActivity('provider-login','admin_login','login','users');
                    return Redirect::route('user-profile');

                }
            }
        }
        if(Session::get('type')!='admin')
        {
            Auth::logout();
            return Redirect::back();
        }
        #UsersController::newUserActivity('admin-login','admin_login','login','users');
        #return Redirect::route('admin');
    }
    public function client_login_check()
    {
        if (!Auth::check())
        {
            $auth=UsersController::authCheck();
            if($auth==false)
            {
                Session::flash('login-modal','yes');
                return Redirect::route('home');
            }
        }
        if(Session::get('type')!='client')
        {
            Session::forget('message');
            session::flash('danger','Sorry, Invalid email or password.');
            Session::flash('login-modal','yes');
            Auth::logout();
            return Redirect::back();
        }
        UsersController::newUserActivity('client-login','client_login','login','users');

        return Redirect::route('account');
    }
    public function client_login_check_checkout()
    {
        if (!Auth::check())
        {
            $auth=UsersController::authCheck();
            if($auth==false)
            {
                return Redirect::route('login_checkout');
            }
        }
        if(Session::get('type')!='client')
        {
            Session::forget('message');
            session::flash('danger','Sorry, Invalid email or password.');
            Auth::logout();
            return Redirect::route('login_checkout');
        }
        UsersController::newUserActivity('client-login','client_login','login','users');

        return Redirect::route('checkout');
    }
    public static function newUserActivity($action_name,$action_url,$action_details,$action_table)
    {
        $user_act_model = new UserActivity();
        $user_activity = [
            'action_name' => $action_name,
            'action_url' => $action_url,
            'action_details' => Auth::user()->username.' '. $action_details,
            'action_table' => $action_table,
            'date' => date('Y-m-d h:i:s', time()),
            'user_id' => Auth::user()->id,
        ];
        $user_act_model->create($user_activity);
    }

    private static function authCheck()
    {
        $data = Input::all();
        if(isset($data['email']) && isset($data['password']))
        {
            //date_default_timezone_set("Asia/Dacca");
            $field = filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user_data = User::where($field, $data['email'])->first();

            if(count($user_data) ==1)
            {
                $attempt = Auth::attempt([
                    $field => $data['email'],
                    'password' => $data['password'],
                ]);
                if($attempt)
                {
                    if($user_data->activated==1) {
                        Session::put('email', $user_data->email);
                        Session::put('user_id', $user_data->id);
                        Session::put('type', $user_data->type);
                        Session::flash('message', "Successfully  Logged In.");
                        return $user_data;
                    }else{
                        Auth::logout();
                        Session::flash('danger', "Account is inactive");
                    }
                }else{
                    Session::flash('danger', "Password Incorrect.Please Try Again");
                }
            }else{
                Session::flash('danger', "Invalid Email/Username.Please Try Again");
            }

        }
        return false;
    }
//	private static function authCheck(){
//		if (Auth::check())
//		{
//    		return Redirect::route('home');
//    	}else{
//			$email = Input::get('login-email');
//			$password = Input::get('login-password');
//			$rules = array(
//				        'login-email' => 'required|email',
//				        'login-password'  => 'required|min:6',
//				    );
//			$validator = Validator::make(Input::all(), $rules);
//			if ($validator->fails())
//			{
//			   return $validator;
//			}
//
//			if(Auth::attempt(array('email' => $email, 'password' => $password))){
//			    return true;
//			}else{
//				 return false;
//			}
//		}
//	}
	public function postRegister(){
		$rules = array(
//					'username' => 'required|min:3|unique:users',
			        'email' => 'required|email|unique:users',
			        'email1' => 'required|email|same:email',
			        'pass'  => 'required|min:6',
//			        'g-recaptcha-response' => 'required|recaptcha',
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
        UsersController::newUserActivity('logout','logout','logout','users');
		Auth::logout();
        return Redirect::route('home');
	}
	public function getAccount(){
		if(Auth::check() && Auth::user()->type=='client'){
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
				$user->department = Input::get('department');
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