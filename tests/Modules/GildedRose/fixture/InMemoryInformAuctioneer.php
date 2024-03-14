<?php
declare(strict_types=1);

namespace App\Tests\Modules\GildedRose\fixture;

use App\Module\GildedRose\Dependencies\InformAuctioneerInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;

class InMemoryInformAuctioneer implements InformAuctioneerInterface
{
    /** @var string[] */
    private $productsAuctioneerWasInformedAbout = [];

    public function inform(UnidentifiedProduct $product): void
    {
        $this->productsAuctioneerWasInformedAbout[] = $product->name();
    }

    /**
     * @return string[]
     */
    public function listInformedAboutProducts(): array {
        return $this->productsAuctioneerWasInformedAbout;
    }
}