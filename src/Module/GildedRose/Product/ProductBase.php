<?php
declare(strict_types=1);

namespace App\Module\GildedRose\Product;

abstract class ProductBase implements IdentifiedProductInterface
{
    public function __construct(protected UnidentifiedProduct $unidentifiedVersion) {

    }

    public function aDayPasses(): IdentifiedProductInterface
    {
        $newVersion = new UnidentifiedProduct(
            $this->unidentifiedVersion->name(),
            $this->valueAfterADayPasses(),
            $this->durabilityAfterADayPasses()
        );

        return new static($newVersion);
    }

    public function unidentify(): UnidentifiedProduct
    {
        return $this->unidentifiedVersion;
    }

    public function value(): int {
        return $this->unidentifiedVersion->value();
    }

    abstract protected function valueAfterADayPasses(): int;

    abstract protected function durabilityAfterADayPasses(): int;

}