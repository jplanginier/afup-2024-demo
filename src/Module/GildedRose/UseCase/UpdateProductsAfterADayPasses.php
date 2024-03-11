<?php
declare(strict_types=1);

namespace App\Module\GildedRose\UseCase;

use App\Module\GildedRose\ProductRepositoryInterface;

class UpdateProductsAfterADayPasses
{
    public function __construct(private ProductRepositoryInterface $productRepository) {

    }

    public function __invoke() {
        $products = $this->productRepository->productsIterable();
        foreach($products as $product) {
            $this->productRepository->updateProduct($product->aDayPasses());
        }
    }
}