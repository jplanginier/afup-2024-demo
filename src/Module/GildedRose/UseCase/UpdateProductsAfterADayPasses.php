<?php
declare(strict_types=1);

namespace App\Module\GildedRose\UseCase;

use App\Module\GildedRose\ProductIdentifier;
use App\Module\GildedRose\ProductRepositoryInterface;

class UpdateProductsAfterADayPasses
{
    public function __construct(private ProductRepositoryInterface $productRepository) {

    }

    public function __invoke() {
        $productIdentifier = new ProductIdentifier();
        $products = $this->productRepository->productsIterable();
        foreach($products as $product) {
            $identifiedProduct = $productIdentifier->identify($product);
            $alteredProduct = $identifiedProduct->aDayPasses();
            $this->productRepository->updateProduct($alteredProduct->unidentify());
        }
    }
}