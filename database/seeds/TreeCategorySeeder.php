<?php

use Illuminate\Database\Seeder;

class TreeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Category::all();
        foreach ($categories as $category) {
            $category_parser = new \App\Libraries\Parsers\CategoryParser();
            $category_parser->set_category($category)->set_automatic_delimiter()->to_lower()->parse_category();
        }
    }
}
