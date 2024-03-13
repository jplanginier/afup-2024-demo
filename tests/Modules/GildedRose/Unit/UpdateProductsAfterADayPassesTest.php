<?php
declare(strict_types=1);

namespace App\Tests\Modules\GildedRose\Unit;

use App\Module\GildedRose\Product\UnidentifiedProduct;
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

    public function testProductGainsOneValueAndLoseADurabilityWhenADayPasses(): void {
        $repository = new StaticProductRepository(new UnidentifiedProduct(name: 'my product', value: 15, durability: 7));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('my product');
        $this->assertEquals(16, $modifiedProduct->value());
        $this->assertEquals(6, $modifiedProduct->durability());
    }

    public function testProductLoseValueWhenDurabilityIsNegative(): void {
        $repository = new StaticProductRepository(new UnidentifiedProduct(name: 'my product', value: 15, durability: -1));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('my product');
        $this->assertEquals(14, $modifiedProduct->value());
        $this->assertEquals(-2, $modifiedProduct->durability());
    }

    public function testProductIsACheeseAndGetsMoreValuePerDayWhenDurabilityIsPositive(): void {
        $repository = new StaticProductRepository(new UnidentifiedProduct(name: 'cheddar', value: 15, durability: 15));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('cheddar');
        $this->assertEquals(18, $modifiedProduct->value());
        $this->assertEquals(14, $modifiedProduct->durability());
    }

    public function testProductIsACheeseAndLoseALotOfValuePerDayWhenDurabilityIsNegative(): void {
        $repository = new StaticProductRepository(new UnidentifiedProduct(name: 'cheddar', value: 15, durability: -1));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('cheddar');
        $this->assertEquals(5, $modifiedProduct->value());
        $this->assertEquals(-2, $modifiedProduct->durability());
    }

    public function testDoomHammerIsLegendaryAndWillHaveAFixedValueAndWontLoseDurability(): void {
        $repository = new StaticProductRepository(new UnidentifiedProduct(name: 'Doomhammer', value: 1, durability: 20));

        $sut = new UpdateProductsAfterADayPasses($repository);

        $sut->__invoke();

        $modifiedProduct = $repository->getByName('Doomhammer');
        $this->assertEquals(1000, $modifiedProduct->value());
        $this->assertEquals(20, $modifiedProduct->durability());
    }

    // edge case : durability is at 0 before the day passes
    // edge case : durability is at 0 after the day passes
    // if named "Ticket : xxx" : value + 5 when durability positive, goes to 0 when durability is null (or negative)
    // if named "Curse of xxx", stop all process and throw Exception : the product would corrupt our shop !
    // product with null or negative value : message to auctioneer to remove the item later that day

}