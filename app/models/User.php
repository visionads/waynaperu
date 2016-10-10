<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    protected $fillable=[
        'facebook_id',
        'email',
        'username',
        'password',
        'type',
        'permissions',
        'activated',
        'activation_code',
        'activated_at',
        'last_login',
        'persist_code',
        'reset_password',
        'first_name',
        'last_name',
        'phone',
        'dob',
        'passport',
        'direction',
        'flat',
        'department',
        'district',
        'city',
        'province',
        'address',
        'remember_token'
    ];

}
