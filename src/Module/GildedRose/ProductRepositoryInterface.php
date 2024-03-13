<?php
declare(strict_types=1);

namespace App\Module\GildedRose;

use App\Module\GildedRose\Product\UnidentifiedProduct;

interface ProductRepositoryInterface
{
    /**
     * @return iterable<UnidentifiedProduct>
     */
    public function productsIterable(): iterable;

    public function updateProduct(UnidentifiedProduct $product): void;
}