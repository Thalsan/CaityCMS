<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreeCategory extends Model
{
    protected $table = 'tree_categories';
    protected $guarded = ['id'];

    public function children() {
        return $this->hasMany('App\TreeCategory','parent_id','id');
    }

    public function get_breadcrumbs() {
        $new_crumbs = [];
        $new_crumb = [[
            'name'  => $this->name,
            'id'    => $this->id
        ]];

        if ($this->has_parent()) {
            $new_crumbs = TreeCategory::find($this->parent_id)->get_breadcrumbs();
        }
        $breadcrumbs = array_merge($new_crumbs, $new_crumb);
        return $breadcrumbs;
    }

    public function has_parent() {
        if ($this->parent_id != null) {
            return true;
        } else {
            return false;
        }
    }
}
