<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

class CommonProduct extends ProductBase
{
    protected function valueAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() > 0
            ? $this->unidentifiedVersion->value() + 1
            : $this->unidentifiedVersion->value() - 1;
    }

    protected function durabilityAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() - 1;
    }
}