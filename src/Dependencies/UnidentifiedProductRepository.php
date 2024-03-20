<?php
declare(strict_types=1);

namespace App\Dependencies;

use App\Entity\Product;
use App\Module\GildedRose\Dependencies\ProductRepositoryInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;
use App\Repository\ProductRepository;

class UnidentifiedProductRepository implements ProductRepositoryInterface
{
    public function __construct(private ProductRepository $productRepository) {

    }

    public function productsIterable(): iterable
    {
        $products = $this->productRepository->findAll();

        foreach($products as $product) {
            yield new UnidentifiedProduct(
                name: $product->name(),
                value: $product->value(),
                durability: $product->durability()
            );
        }
    }

    public function updateProduct(UnidentifiedProduct $product): void
    {
        $doctrineEntity = new Product(
            name: $product->name(),
            value: $product->value(),
            durability: $product->durability()
        );

        $this->productRepository->update($doctrineEntity);
    }
}