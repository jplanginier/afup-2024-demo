<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

class Doomhammer extends ProductBase
{
    protected function valueAfterADayPasses(): int
    {
        return 1000;
    }

    protected function durabilityAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability();
    }
}