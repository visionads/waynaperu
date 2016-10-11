<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 10/10/16
 * Time: 4:07 PM
 */
class BankAccount extends Eloquent
{
    protected $table='user_bank_accounts';
    protected $fillable=[
        'user_id',
        'account_number',
        'account_type'
    ];
}