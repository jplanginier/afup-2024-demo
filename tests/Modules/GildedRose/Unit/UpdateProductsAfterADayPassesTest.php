<?php
declare(strict_types=1);

namespace App\Tests\Modules\GildedRose\Unit;

use PHPUnit\Framework\TestCase;

class UpdateProductsAfterADayPassesTest extends TestCase
{
    public function testItWorks(): void {
        $this->assertTrue(true);
    }

    // product has a name, a value, and a durability in days
    // products are taken from a repository
    // products are iterated over (not all products are loaded)
    // standard product = 1 day passes : -1 durability, + 1 value
    // if durability < 0 : 1 day passes : -1 durability, -1 value
    // if is a cheese from a list, +3 value if durability is positive, -10 if negative
    // if named "doom hammer", legendary : value is set to 1000, durability won't move
    // if named "Ticket : xxx" : value + 5 when durability positive, goes to 0 when durability is null (or negative)
    // if named "Curse of xxx", stop all process and throw Exception : the product would corrupt our shop !
    // product with null or negative value : message to auctioneer to remove the item later that day

}