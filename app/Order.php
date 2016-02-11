<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart');
    }
}
