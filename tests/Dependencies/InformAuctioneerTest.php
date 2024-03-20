<?php
declare(strict_types=1);

namespace App\Tests\Dependencies;

use App\Dependencies\InformAuctioneer;
use App\Dependencies\UnidentifiedProductRepository;
use App\Module\GildedRose\Product\UnidentifiedProduct;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\InMemory\InMemoryTransport;

class InformAuctioneerTest extends KernelTestCase
{
    /**
     * Note:
     * Tests are done on Symfony Messenger, because I take as granted that using SF Messenger
     * with another transport will work.
     * If I was to use a lower level library to send messages on a broker like rabbitMQ,
     * I would have to test against a rabbitMQ container on which I would reset data between every test.
     */

    private InMemoryTransport $transport;

    public function setUp(): void
    {
        $this->bootKernel();
        $this->transport = static::getContainer()->get('messenger.transport.sync');
    }

    public function testAuctioneerHasHisMessageInSfMessengerTransport(): void {
        /** @var InformAuctioneer $sut */
        $sut = static::getContainer()->get(InformAuctioneer::class);

        $product = new UnidentifiedProduct('a product', 14, 0);
        $sut->inform($product);

        $message =  $this->transport->get()[0]->getMessage();

        $this->assertEquals($message->product(), clone $product);
    }
}
