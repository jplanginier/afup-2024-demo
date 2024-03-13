<?php
declare(strict_types=1);

namespace App\Module\GildedRose;

use App\Module\GildedRose\Exception\CursedProductException;
use App\Module\GildedRose\Product\Cheese;
use App\Module\GildedRose\Product\CommonProduct;
use App\Module\GildedRose\Product\Doomhammer;
use App\Module\GildedRose\Product\IdentifiedProductInterface;
use App\Module\GildedRose\Product\Ticket;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class ProductIdentifier
{
    public function identify(UnidentifiedProduct $product): IdentifiedProductInterface {

        if ($this->isACurse($product)) {
            throw new CursedProductException();
        }

        if ($this->isCheese($product)) {
            return new Cheese($product);
        }

        if ($this->isDoomhammer($product)) {
            return new Doomhammer($product);
        }

        if ($this->isATicket($product)) {
            return new Ticket($product);
        }

        return new CommonProduct($product);
    }

    private function isCheese(UnidentifiedProduct $product): bool {
        return in_array($product->name(), ['cheddar']);
    }

    private function isDoomHammer(UnidentifiedProduct $product) {
        return $product->name() === 'Doomhammer';
    }

    private function isATicket(UnidentifiedProduct $product) {
        return str_starts_with($product->name(), 'Ticket :');
    }

    private function isACurse(UnidentifiedProduct $product) {
        return str_starts_with($product->name(), "Curse of ");
    }


}