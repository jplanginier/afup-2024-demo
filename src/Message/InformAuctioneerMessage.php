<?php

namespace App\Message;

use App\Module\GildedRose\Product\UnidentifiedProduct;

final class InformAuctioneerMessage
{
    public function __construct(private UnidentifiedProduct $product) {

    }

    public function product(): UnidentifiedProduct {
        return $this->product;
    }
}
