<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/4/16
 * Time: 12:30 PM
 */
class UserController extends BaseController
{
    public function index()
    {
        $per_page=20;
        $data['serial']=getSerialNum($per_page);
        $data['users']= User::paginate($per_page);
        return View::make('admin.user.index',$data);
    }
    public function create()
    {
        return View::make('admin.user.create');
    }
    public function store()
    {
        $input=Input::all();
        $validator = Validator::make($input,[
            'email' => 'unique:users',
            'username' => 'unique:users',
            'password' => 'required'
        ]);
        if($validator->fails())
        {
            return Redirect::back()->withInput();
        }else {
            $user = new User();
            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->email = $input['email'];
            $user->username = $input['username'];
            $user->type = $input['type'];
            $user->password = Hash::make($input['password']);
            $user->save();
            if($user->type=='provider')
            {
                $provider= new Provider();
                $provider->user_id=$user->id;
                $provider->save();
            }elseif($user->type=='client')
            {
                $client= new Client();
                $client->user_id=$user->id;
                $client->save();
            }
            Session::flash('message','User added successfully.');
            return Redirect::to('users');
        }
    }
    public function edit($user_id)
    {
        $data['user']= User::find($user_id);
        return View::make('admin.user.edit',$data);
    }
    public function update($user_id)
    {
        $input=Input::all();

        $user = User::find($user_id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->username = $input['username'];
        $user->type = $input['type'];
        if(isset($input['password']) && !empty($input['password']))
        {
            $user->password = Hash::make($input['password']);
        }
        $user->save();
        Session::flash('message','User updated successfully.');
        return Redirect::to('users');
    }
    public function profile($user_id=false)
    {
        if(empty($user_id))
        {
            $user_id = Auth::user()->id;
        }
        $data['user']= User::with('relClient','relProvider','relPhoneNumber','relBankAccount')->where('id',$user_id)->first();
//        dd($data);
        return View::make('admin.profile',$data);
    }
    public function update_profile($user_id)
    {
        $input=Input::all();

        $user = User::find($user_id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->dob = $input['dob'];
        $user->passport = $input['passport'];
        $user->direction = $input['direction'];
        $user->flat = $input['flat'];
        $user->department = $input['department'];
        $user->district = $input['district'];
        $user->city = $input['city'];
        $user->province = $input['province'];
        $user->address = $input['address'];
        $user->save();
        Session::flash('message','User updated successfully.');
        return Redirect::to('users');
    }

    public function edit_profile($user_id)
    {
        $data['user']= User::find($user_id);
        return View::make('admin.user.edit_profile',$data);
    }
    public function add_phone($user_id)
    {
        $data['user']= User::find($user_id);
        return View::make('admin.user.add_phone',$data);
    }
    public function store_phone_number($user_id)
    {
        $input=Input::all();

        $phone= new PhoneNumber();
        $phone->user_id = $user_id;
        $phone->number = $input['number'];
        $phone->save();
        Session::flash('message','Phone number stored successfully.');
        return Redirect::to('profile/'.$user_id);
    }
    public function edit_phone($id)
    {
        $data['phone']=PhoneNumber::find($id);
        $data['user']= User::find($data['phone']->user_id);
        return View::make('admin.user.edit_phone',$data);
    }
    public function update_phone_number($id)
    {
        $input=Input::all();

        $phone= PhoneNumber::find($id);
        $phone->number = $input['number'];
        $phone->save();
        Session::flash('message','Phone number updated successfully.');
        return Redirect::to('profile/'.$phone->user_id);
    }
    public function delete_phone($id)
    {
        $phone= PhoneNumber::find($id);
        $phone->delete();
        Session::flash('message','Phone number deleted successfully.');
        return Redirect::to('profile/'.$phone->user_id);
    }
    public function add_bank($user_id)
    {
        $data['user']= User::find($user_id);
        return View::make('admin.user.add_bank',$data);
    }
    public function store_bank($user_id)
    {
        $input=Input::all();

        $bank= new BankAccount();
        $bank->user_id = $user_id;
        $bank->name = $input['name'];
        $bank->account_number = $input['account_number'];
        $bank->account_type = $input['account_type'];
        $bank->save();
        Session::flash('message','Bank information stored successfully.');
        return Redirect::to('profile/'.$user_id);
    }
    public function edit_bank($id)
    {
        $data['bank']=BankAccount::find($id);
        $data['user']= User::find($data['bank']->user_id);
        return View::make('admin.user.edit_bank',$data);
    }
    public function update_bank($id)
    {
        $input=Input::all();

        $bank= BankAccount::find($id);
        $bank->name = $input['name'];
        $bank->account_number = $input['account_number'];
        $bank->account_type = $input['account_type'];
        $bank->save();
        Session::flash('message','Bank information updated successfully.');
        return Redirect::to('profile/'.$bank->user_id);
    }
    public function delete_bank($id)
    {
        $bank= BankAccount::find($id);
        $bank->delete();
        Session::flash('message','Bank information deleted successfully.');
        return Redirect::to('profile/'.$bank->user_id);
    }
    public function add_additional_info($user_id)
    {
        $data['user']= User::find($user_id);
        if($data['user']->type=='client')
        {
            $data['client_info']=Client::where('user_id',$user_id)->first();
            return View::make('admin.user.add_client_info',$data);
        }else{
            $data['provider_info']=Provider::where('user_id',$user_id)->first();
            return View::make('admin.user.add_provider_info',$data);
        }
    }
    public function update_provider_info($user_id)
    {
        $input=Input::all();
        $provider= Provider::where('user_id',$user_id)->first();
        $provider->vat_number=$input['vat_number'];
        $provider->incharge=$input['incharge'];
        $provider->contact_expire_date=$input['contact_expire_date'];
        $provider->contact_valid_until=$input['contact_valid_until'];
        $provider->save();
        Session::flash('message','Provider information update successfully.');
        return Redirect::to('profile/'.$user_id);
    }
    public function update_client_info($user_id)
    {
        $input=Input::all();
        $client= Client::where('user_id',$user_id)->first();
        $client->date_of_inscription=$input['date_of_inscription'];
        $client->blog_comments=$input['blog_comments'];
        $client->experience_review=$input['experience_review'];
        $client->amount_of_purchase=$input['amount_of_purchase'];
        $client->save();
        Session::flash('message','Client information update successfully.');
        return Redirect::to('profile/'.$user_id);
    }

    public function destroy($user_id)
    {
        User::find($user_id)->delete();
        Session::flash('message','User has been successfully deleted.');
        return Redirect::back();
    }
}