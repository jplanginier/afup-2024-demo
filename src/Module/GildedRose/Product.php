<?php
declare(strict_types=1);

namespace App\Module\GildedRose;

readonly class Product
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

    public function aDayPasses(): Product {
        $durability = $this->durability - 1;
        $value = $this->value + 1;

        return new Product($this->name, $value, $durability);
    }
}