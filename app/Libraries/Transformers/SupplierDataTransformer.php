<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 14-3-2017
 * Time: 12:21
 */

namespace App\Libraries\Transformers;

use App\SupplierData;
use League\Fractal\TransformerAbstract;

class SupplierDataTransformer extends TransformerAbstract
{
    /**
     * @param SupplierData $supplier_data
     * @return array
     * @internal param Product $product
     */
    public function transform(SupplierData $supplier_data)
    {
        return [
            'Supplier id'               => $supplier_data->supplier->id,
            'Supplier data id'          => $supplier_data->id,
            'Name'                      => $supplier_data->name,
            'Brand'                     => $supplier_data->brand,
            'SKU'                       => $supplier_data->sku,
            'EAN'                       => $supplier_data->ean,
            'Price'                     => $supplier_data->price,
            'Stock'                     => $supplier_data->stock,
            'Status'                    => $supplier_data->enabled ? 'enabled' : 'disabled',
            'Recommended retail price'  => $supplier_data->recommended_retail_price,
            'Delivery period'           => $supplier_data->deliveryPeriod->text,
            'Weight'                    => $supplier_data->weight,
            'Created at'                => (string) $supplier_data->created_at,
            'Updated at'                => (string) $supplier_data->updated_at,
        ];
    }
}