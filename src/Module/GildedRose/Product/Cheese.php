<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

class Cheese extends ProductBase
{
    protected function valueAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() > 0
            ? $this->unidentifiedVersion->value() + 3
            : $this->unidentifiedVersion->value() - 10;
    }

    protected function durabilityAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() - 1;
    }
}