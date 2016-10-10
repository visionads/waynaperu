<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/10/16
 * Time: 4:07 PM
 */
class PhoneNumber extends Eloquent
{
    protected $table='phone_numbers';
    protected $fillable=[
        'user_id',
        'number'
    ];
}