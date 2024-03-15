<?php
declare(strict_types=1);

namespace App\Tests\Dependencies;

use App\Dependencies\InformAuctioneer;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InformAuctioneerTest extends KernelTestCase
{
    /**
     * Note:
     * Tests are done on Symfony Messenger, because I take as granted that using SF Messenger
     * with another transport will work.
     * If I was to use a lower level library to send messages on a broker like rabbitMQ,
     * I would have to test against a rabbitMQ container on which I would reset data between every test.
     */

    // check that message is added into messenger transport when inform is called
}
