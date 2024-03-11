<?php
declare(strict_types=1);

namespace App\Tests\Modules\GildedRose\Unit;

use App\Module\GildedRose\Product;
use App\Module\GildedRose\ProductRepositoryInterface;
use App\Module\GildedRose\UseCase\UpdateProductsAfterADayPasses;
use App\Tests\Modules\GildedRose\fixture\StaticProductRepository;
use PHPUnit\Framework\TestCase;

class UpdateProductsAfterADayPassesTest extends TestCase
{
    public function testProductsAreLoadedFromRepository(): void {
        $repository = new StaticProductRepository();
        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $this->assertTrue($repository->wasCalled());
    }

    public function testProductChangedAfterADay(): void {
        $repository = new StaticProductRepository(new Product(name: 'my product', value: 15, durability: 7));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('my product');
        $this->assertEquals(16, $modifiedProduct->value());
        $this->assertEquals(6, $modifiedProduct->durability());
    }

    // product has a name, a value, and a durability in days
    // if durability < 0 : 1 day passes : -1 durability, -1 value
    // if is a cheese from a list, +3 value if durability is positive, -10 if negative
    // if named "doom hammer", legendary : value is set to 1000, durability won't move
    // if named "Ticket : xxx" : value + 5 when durability positive, goes to 0 when durability is null (or negative)
    // if named "Curse of xxx", stop all process and throw Exception : the product would corrupt our shop !
    // product with null or negative value : message to auctioneer to remove the item later that day

}