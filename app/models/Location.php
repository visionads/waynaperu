<?php



class Location extends Eloquent {

    

    protected $table = 'locations';
    public $timestamps = true;
    public $primaryKey = 'id';

    public function delete()
    {
        LocationContent::where('loc_id', '=', $this->id)->delete();
        return parent::delete();
    }

     public function product()
      {
        return $this->belongsTo("Product");
      }

}