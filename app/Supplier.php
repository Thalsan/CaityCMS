<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $guarded = ['id'];

    public function supplier_config() {
        return $this->hasMany('App\Supplier_config');
    }

    public function supplier_pricing() {
        return $this->hasOne('App\Supplier_pricing');
    }

}
