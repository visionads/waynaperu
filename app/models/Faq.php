<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Faq extends Eloquent implements UserInterface, RemindableInterface{


    use UserTrait, RemindableTrait;

    protected $table = 'faqs';
    public $timestamps = true;
    public $primaryKey = 'id';
    public function delete()
    {
        Faqcontent::where('faq_id', '=', $this->id)->delete();
        return parent::delete();
    }

    public function languages()
    {
        return $this->hasOne('Language');
    }
    public function contents()
    {
        return $this->hasMany('Faqcontent');
    }
}

