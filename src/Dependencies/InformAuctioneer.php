<?php
declare(strict_types=1);

namespace App\Dependencies;

use App\Message\InformAuctioneerMessage;
use App\Module\GildedRose\Dependencies\InformAuctioneerInterface;
use App\Module\GildedRose\Product\UnidentifiedProduct;
use Symfony\Component\Messenger\MessageBusInterface;

class InformAuctioneer implements InformAuctioneerInterface
{
    public function __construct(private MessageBusInterface $messageBus) {

    }

    public function inform(UnidentifiedProduct $product): void
    {
        $this->messageBus->dispatch(new InformAuctioneerMessage($product));
    }
}