<?php
declare(strict_types=1);

namespace App\Module\GildedRose;

use Iterator;

interface ProductRepositoryInterface
{
    /**
     * @return iterable<Product>
     */
    public function productsIterable(): iterable;

    public function updateProduct(Product $product): void;
}