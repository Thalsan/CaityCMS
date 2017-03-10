<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreeCategory extends Model
{
    protected $table = 'tree_categories';
    protected $guarded = ['id'];

    public function children() {
        return $this->hasMany('App\TreeCategory','parent_id','id') ;
    }
}
