<?php

class Product extends Eloquent {

    protected $table = 'products';

    public $timestamps = true;

    public $primaryKey = 'id';

    public function delete()
    {

        $p_id = $this->id;

        ProductContent::where('product_id', '=', $p_id)->delete();

        ProductImages::where('product_id', '=', $p_id)->delete();

        $ids = DB::table('locations')->where('product_id', $p_id )->get();

    	foreach ($ids as $key => $value) {

    	     LocationContent::where('loc_id', '=', $value->id)->delete();

    	 }

	    Location::where('product_id', '=', $p_id )->delete();

        $fids = DB::table('faqs')->where('product_id', $p_id )->get();

        foreach ($fids as $key => $value) {

             Faqcontent::where('faq_id', '=', $value->id)->delete();

         }

        Faq::where('product_id', '=', $p_id )->delete();

        return parent::delete();

    }

    public function category()
    {

        return $this->belongsTo("Category", 'cat_id');

    }

}
