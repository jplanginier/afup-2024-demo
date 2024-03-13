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

        if ($this->isDoomHammer()) {
            return new Product($this->name, 1000, $this->durability);
        }

        $durability = $this->durability - 1;
        if ($durability < 0) {
            if ($this->isCheese()) {
                $value = $this->value - 10;
            } else {
                $value = $this->value - 1;
            }
        } else {
            if ($this->isCheese()) {
                $value = $this->value + 3;
            } else {
                $value = $this->value + 1;
            }
        }

        return new Product($this->name, $value, $durability);
    }

    private function isCheese(): bool {
        return in_array($this->name, ['cheddar']);
    }

    private function isDoomHammer() {
        return $this->name === 'Doomhammer';
    }


}