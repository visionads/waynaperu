<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class District extends Eloquent  implements UserInterface, RemindableInterface  {
    use UserTrait, RemindableTrait;

    protected $table = 'districts';
    public $timestamps = true;
    public $primaryKey = 'id';
    
   

}