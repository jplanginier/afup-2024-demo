<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

class Ticket extends ProductBase
{

    protected function valueAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() > 1
            ? $this->unidentifiedVersion->value() + 5
            : 0;
    }

    protected function durabilityAfterADayPasses(): int
    {
        return $this->unidentifiedVersion->durability() - 1;
    }
}