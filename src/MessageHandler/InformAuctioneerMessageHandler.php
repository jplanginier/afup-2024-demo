<?php

namespace App\MessageHandler;

use App\Message\InformAuctioneerMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class InformAuctioneerMessageHandler
{
    public function __invoke(InformAuctioneerMessage $message)
    {
        // do something with your message
    }
}
