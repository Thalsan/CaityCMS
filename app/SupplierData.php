<?php

namespace App;

use App\Libraries\Transformers\SupplierDataTransformer;
use Illuminate\Database\Eloquent\Model;
use Spatie\Fractalistic\ArraySerializer;

class SupplierData extends Model
{
    protected $table = 'supplier_data';

    protected $guarded = ['id'];

    protected $touches = ['product'];

    public function supplier() {
        return $this->belongsTo('App\Supplier');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function deliveryPeriod() {
        return $this->belongsTo('App\DeliveryPeriod');
    }

    public function setDeliveryPeriod($value) {
        $this->attributes['delivery_period_id'] = $value ?: null;
    }

    public function get_modal_data () {
        return fractal($this, new SupplierDataTransformer(), new ArraySerializer())->toArray();
    }
}
