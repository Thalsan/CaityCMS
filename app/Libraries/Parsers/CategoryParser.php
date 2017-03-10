<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 9-3-2017
 * Time: 12:24
 */

namespace App\Libraries\Parsers;


use App\Category;
use App\CategoryDelimiter;
use App\TreeCategory;

class CategoryParser
{
    public $category;
    public $delimiter;
    public $parsed_category = [];

    public function set_category (Category $category) {
        $this->category = $category;
        return $this;
    }

    public function set_manual_delimiter ($delimiter) {
        $this->delimiter = $delimiter;
        return $this;
    }

    public function set_automatic_delimiter () {
        $first_category = explode('|', $this->category->name)[0];
        $category_delimiter = CategoryDelimiter::where('name', '=', $first_category)->first();
        if (count($category_delimiter) > 0) {
            $this->delimiter = $category_delimiter->delimiter;
        } else {
            $this->delimiter = '|';
        }
        return $this;
    }

    public function to_lower () {
        $this->category->name = strtolower($this->category->name);
        return $this;
    }

    public function to_upper () {
        $this->category->name = strtoupper($this->category->name);
        return $this;
    }

    public function parse_category () {
        $split_name = $this->split_category_name();
        $depth = 0;
        $parent_id = null;
        while (count($split_name) > 0) {
            $tree_category = TreeCategory::where([['name', $split_name[0]], ['depth', $depth]])->first();
            if (count($tree_category) == 0) {
                $parent_id = $this->save($split_name[0], $depth, $parent_id);
            } else {
                $parent_id = $tree_category->id;
            }
            $depth++;
            array_shift($split_name);
        }
        echo "Parsed category!\r\n";
    }

    private function save ($name, $depth, $parent_id) {
        $tree_category = new TreeCategory();
        $tree_category->name = $name;
        $tree_category->depth = $depth;
        $tree_category->parent_id = $parent_id;
        $tree_category->save();
        return $tree_category->id;
    }

    private function split_category_name () {
        $category_name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $this->category->name);
        if ($this->delimiter == '|') {
            $split_name = explode($this->delimiter, $category_name);
        } else {
            $uncompleted_split = explode('|', $category_name);
            $second_part = ltrim($uncompleted_split[1], $this->delimiter);
            unset($uncompleted_split[1]);
            $split_name = array_merge($uncompleted_split, explode($this->delimiter, $second_part));
        }
        return $split_name;
    }
}