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
    public function destroy($user_id)
    {
        User::find($user_id)->delete();
        Session::flash('message','User has been successfully deleted.');
        return Redirect::back();
    }
}