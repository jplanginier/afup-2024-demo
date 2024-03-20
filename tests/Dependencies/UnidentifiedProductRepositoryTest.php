<?php
declare(strict_types=1);

namespace App\Tests\Dependencies;

use App\Dependencies\UnidentifiedProductRepository;
use App\Entity\Product;
use App\Module\GildedRose\Product\UnidentifiedProduct;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UnidentifiedProductRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $em;

    public function setUp(): void
    {
        $this->bootKernel();
        $this->em = static::getContainer()->get(EntityManagerInterface::class);
        $schemaTool = new SchemaTool($this->em);
        $metadata = [$this->em->getMetadataFactory()->getMetadataFor(Product::class)];
        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata);
    }

    public function testProductsAreFetched(): void
    {
        /** @var UnidentifiedProductRepository $sut */
        $sut = static::getContainer()->get(UnidentifiedProductRepository::class);

        $this->em->persist(new Product('a product', 15, 15));
        $this->em->persist(new Product('another product', 99, 21));
        $this->em->flush();

        $products = [];
        foreach ($sut->productsIterable() as $product) {
            $products[] = $product;
        }

        $expected = [
            new UnidentifiedProduct('a product', 15, 15),
            new UnidentifiedProduct('another product', 99, 21),
        ];

        $this->assertEquals($expected, $products);
    }

    public function testNewProductIsInsertedIntoDb(): void {
        /** @var UnidentifiedProductRepository $sut */
        $sut = static::getContainer()->get(UnidentifiedProductRepository::class);

        $sut->updateProduct(new UnidentifiedProduct('a product', 30, 50));

        /** @var ProductRepository $repository */
        $repository = static::getContainer()->get(ProductRepository::class);

        // added to prevent getting the product from doctrine memory
        $this->em->clear();

        $savedProduct = $repository->findOneBy(['name' => 'a product']);
        $this->assertEquals(new Product('a product', 30, 50, $savedProduct), $savedProduct);
    }

    // edge case : there is no product in repo
    // check update existing product does not create a new one
    // check updating a product won't affect another one
}
