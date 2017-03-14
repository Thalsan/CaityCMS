<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 14-3-2017
 * Time: 12:21
 */

namespace App\Libraries\Transformers;

use League\Fractal\TransformerAbstract;
use App\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'name'                      => $product->name,
            'basic'                     => [
                'id'                        => $product->id,
                'unique_part'               => $product->unique_part,
                'brand'                     => $product->brand,
                'short_description'         => $product->short_description,
                'long_description'          => $product->long_description,
                'sku'                       => $product->sku,
                'ean'                       => $product->ean,
                'created_at'                => (string) $product->created_at,
                'updated_at'                => (string) $product->updated_at,
            ],
            'pricing'                   => [
                'recommended_retail_price'  => $product->recommended_retail_price,
            ]
        ];
    }
}