<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'sku', 'price', 'description', 'is_downloadable'];

	public function orders()
	{
		return $this->hasMany('App\Order');
	}

    /**
     * @return mixed
     * to convert the product price into a penny-based
    representation is very simple:
     */
    public function priceToCents()
    {
    	return $this->price * 100;
    }

}
