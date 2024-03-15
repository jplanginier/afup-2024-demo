<?php
declare(strict_types=1);

namespace App\Dependencies;

use App\Module\GildedRose\Dependencies\ProductRepositoryInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class ProductRepository implements ProductRepositoryInterface
{

    public function productsIterable(): iterable
    {
        // TODO: Implement productsIterable() method.
    }

    public function updateProduct(UnidentifiedProduct $product): void
    {
        // TODO: Implement updateProduct() method.
    }
}