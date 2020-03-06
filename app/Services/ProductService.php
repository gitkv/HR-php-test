<?php


namespace App\Services;


use App\Models\Product;

class ProductService
{

    public function update(Product $product, array $data)
    {
        $product->fill($data);
        $product->save();

        return $product;
    }

}