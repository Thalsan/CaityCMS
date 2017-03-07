<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $table = 'products';
    protected $guarded = ['id'];

    public function supplier_data()
    {
        return $this->hasMany('App\Supplier_data');
    }

    public function categories()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('App\Product_image', 'product_id');
    }
}
