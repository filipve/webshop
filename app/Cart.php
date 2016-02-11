<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $table = 'cart';

    protected $fillable = ['product_id', 'qty', 'price'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}