<?php
declare(strict_types=1);

namespace App\Tests\Modules\GildedRose\fixture;

use App\Module\GildedRose\Dependencies\ProductRepositoryInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class StaticProductRepository implements ProductRepositoryInterface
{
    /** @var UnidentifiedProduct[] */
    private array $products = [];

    private bool $wasCalled = false;

    public function __construct(UnidentifiedProduct ...$products) {
        foreach ($products as $product) {
            $this->updateProduct($product);
        }
    }

    public function updateProduct(UnidentifiedProduct $product): void
    {
        // prevents errors in test where the object is modified by reference, without being really saved
        $this->products[$product->name()] = clone $product;
    }


    /**
     * @return iterable<?UnidentifiedProduct>
     */
    public function productsIterable(): iterable
    {
        $this->wasCalled = true;
        foreach ($this->products as $product) {
            yield $product;
        }
    }

    public function wasCalled() {
        return $this->wasCalled;
    }

    public function getByName(string $name): ?UnidentifiedProduct {
        return $this->products[$name] ?? null;
    }
}