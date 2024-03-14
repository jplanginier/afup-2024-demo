<?php
declare(strict_types=1);

namespace App\Module\GildedRose\UseCase;

use App\Module\GildedRose\Dependencies\InformAuctioneerInterface;
use App\Module\GildedRose\Dependencies\ProductRepositoryInterface;
use App\Module\GildedRose\ProductIdentifier;

class UpdateProductsAfterADayPasses
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private InformAuctioneerInterface $informAuctioneer
    ) {

    }

    public function __invoke() {
        $productIdentifier = new ProductIdentifier();
        $products = $this->productRepository->productsIterable();
        foreach($products as $product) {
            $identifiedProduct = $productIdentifier->identify($product);
            $alteredProduct = $identifiedProduct->aDayPasses();
            $this->productRepository->updateProduct($alteredProduct->unidentify());

            if ($alteredProduct->value() <= 0) {
                $this->informAuctioneer->inform($alteredProduct->unidentify());
            }
        }
    }
}