<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Dependencies;

use App\Module\GildedRose\Product\UnidentifiedProduct;

interface InformAuctioneerInterface
{
    public function inform(UnidentifiedProduct $product): void;
}