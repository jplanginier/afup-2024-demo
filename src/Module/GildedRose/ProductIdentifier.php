<?php
declare(strict_types=1);

namespace App\Module\GildedRose;

use App\Module\GildedRose\Product\Cheese;
use App\Module\GildedRose\Product\CommonProduct;
use App\Module\GildedRose\Product\Doomhammer;
use App\Module\GildedRose\Product\IdentifiedProductInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class ProductIdentifier
{
    public function identify(UnidentifiedProduct $product): IdentifiedProductInterface {
        if ($this->isCheese($product)) {
            return new Cheese($product);
        }

        if ($this->isDoomhammer($product)) {
            return new Doomhammer($product);
        }

        return new CommonProduct($product);
    }

    private function isCheese(UnidentifiedProduct $product): bool {
        return in_array($product->name(), ['cheddar']);
    }

    private function isDoomHammer(UnidentifiedProduct $product) {
        return $product->name() === 'Doomhammer';
    }
}