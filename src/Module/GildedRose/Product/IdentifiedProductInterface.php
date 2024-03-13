<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

interface IdentifiedProductInterface
{
    public function aDayPasses(): IdentifiedProductInterface;

    public function unidentify(): UnidentifiedProduct;
}