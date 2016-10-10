<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/10/16
 * Time: 4:07 PM
 */
class Client extends Eloquent
{
    protected $table='client_info';
    protected $fillable=[
        'user_id',
        'date_of_inscription',
        'experience_review',
        'amount_of_purchase',
        'blog_comments',
    ];
}