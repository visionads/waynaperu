<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/10/16
 * Time: 4:07 PM
 */
class Client extends Eloquent
{
    protected $table='user_client_info';
    protected $fillable=[
        'user_id',
        'date_of_inscription',
        'experience_review',
        'amount_of_purchase',
        'blog_comments',
    ];
    public function relUser()
    {
        return $this->belongsTo('User','user_id','id');
    }
}