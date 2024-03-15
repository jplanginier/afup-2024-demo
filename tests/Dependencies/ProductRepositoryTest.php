<?php
declare(strict_types=1);

namespace App\Tests\Dependencies;

use App\Dependencies\ProductRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{


    // check that a product is fetched from Doctrine DB
    // check that multiple products are fetched, one by one
    // edge case : there is no product in repo
    // check insert new product
    // check update existing product does not create a new one
    // check updating a product won't affect another one
}
