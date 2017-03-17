<?php

namespace App;

use App\Libraries\Transformers\SupplierDataTransformer;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Fractalistic\ArraySerializer;

class Product extends Model
{
    use Searchable;

    protected $table = 'products';
    protected $guarded = ['id'];

    public function supplier_data()
    {
        return $this->hasMany('App\SupplierData');
    }

    public function categories()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('App\Product_image', 'product_id');
    }

    public function get_all_modal_supplier_data () {
        $suppliers = [];
        foreach ($this->supplier_data as $data) {
            $suppliers[$data->supplier->name] = $data->get_modal_data();
        }
        return $suppliers;
    }
}
