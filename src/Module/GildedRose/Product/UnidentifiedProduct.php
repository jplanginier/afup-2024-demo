<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

readonly class UnidentifiedProduct
{
    public function __construct(
        private string $name,
        private int $value,
        private int $durability
    ) {

    }

    public function name() {
        return $this->name;
    }

    public function value() {
        return $this->value;
    }

    public function durability() {
        return $this->durability;
    }
}