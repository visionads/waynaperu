<?php

use Illuminate\Auth\UserTrait;

use Illuminate\Auth\UserInterface;

use Illuminate\Auth\Reminders\RemindableTrait;

use Illuminate\Auth\Reminders\RemindableInterface;



class Order extends Eloquent  implements UserInterface, RemindableInterface  {

    use UserTrait, RemindableTrait;



    protected $table = 'orders';

    public $timestamps = true;

    public $primaryKey = 'id';

    public function delete()

    {

        OrderItems::where('order_id', '=', $this->id)->delete();

        return parent::delete();

    }
    public function relOrderItems()
    {
        return $this->hasMany('OrderItems', 'order_id','id');
    }

    



}