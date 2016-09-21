<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ProductImages extends Eloquent implements UserInterface, RemindableInterface  {
	use UserTrait, RemindableTrait;

    protected $table = 'product_images';
    public $timestamps = true;
    public $primaryKey = 'id';

}
