<?php
declare(strict_types=1);

namespace App\Dependencies;

use App\Module\GildedRose\Dependencies\InformAuctioneerInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class InformAuctioneer implements InformAuctioneerInterface
{

    public function inform(UnidentifiedProduct $product): void
    {
        // TODO: Implement inform() method.
    }
}