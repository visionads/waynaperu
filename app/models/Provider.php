<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/10/16
 * Time: 4:07 PM
 */
class Provider extends Eloquent
{
    protected $table='user_provider_info';
    protected $fillable=[
        'user_id',
        'vat_number',
        'incharge',
        'contact_expire_date',
        'contact_valid_until',
    ];
    public function relUser(){
        return $this->belongsTo('User','user_id','id');
    }
}