<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 9/22/16
 * Time: 12:24 PM
 */
class Slider extends Eloquent
{
    protected $table='slider';
    protected $fillable=[
        'caption',
        'path',
        'status',
        'sequence',
    ];
}