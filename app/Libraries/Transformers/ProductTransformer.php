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
            'Name'                      => $product->name,
            'Basic'                     => [
                'Id'                        => $product->id,
                'Image'                     => $product->image,
                'Brand'                     => $product->brand ?? '-',
                'Short description'         => $product->short_description ?? '-',
                'Long description'          => $product->long_description ?? '-',
                'SKU'                       => $product->sku ?? '-',
                'EAN'                       => $product->ean ?? '-',
                'Status'                    => $product->enabled ? 'enabled' : 'disabled',
                'Weight'                    => $product->weight ?? '-',
                'Created at'                => (string) $product->created_at,
                'Updated at'                => (string) $product->updated_at,
            ],
            'Pricing'                   => [
                'Price [Inc. Tax]'          => 'To Be Continued!',
                'Cost price'                => 'To Be Continued!',
                'Recommended retail price'  => $product->recommended_retail_price,
            ],
            'Metadata'                  => [
                'Meta title'                => $product->meta_title ?? '-',
                'Meta description'          => $product->meta_description ?? '-',
                'Meta keyword'              => $product->meta_keyword ?? '-',
            ],
            'Suppliers'                 => $product->get_all_modal_supplier_data(),
        ];
    }
}