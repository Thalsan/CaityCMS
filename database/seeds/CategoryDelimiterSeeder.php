<?php

use Illuminate\Database\Seeder;

class CategoryDelimiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'name'      =>  'axihandle',
                'delimiter' =>  '|'
            ],
            [
                'name'      =>  'verwimp',
                'delimiter' =>  '|'
            ],
            [
                'name'      =>  'thimbletoys',
                'delimiter' =>  '/'
            ],
            [
                'name'      =>  'beautiful-brandz',
                'delimiter' =>  '|'
            ]
        ];

        foreach ($arr as $item) {
            $category_delimiter = new \App\CategoryDelimiter();
            $category_delimiter->name = $item['name'];
            $category_delimiter->delimiter = $item['delimiter'];
            $category_delimiter->save();
        }
    }
}
