<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ProductContent extends Eloquent implements UserInterface, RemindableInterface  {
	use UserTrait, RemindableTrait;

    protected $table = 'product_content';
    public $timestamps = true;
    public $primaryKey = 'id';

}
