<?php
declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\ADayPassesCommand;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ADayPassesCommandTest extends KernelTestCase
{
    private EntityManagerInterface $em;

    public function setUp(): void
    {
        $this->bootKernel();

        $this->bootKernel();
        $this->em = static::getContainer()->get(EntityManagerInterface::class);
        $schemaTool = new SchemaTool($this->em);
        $metadata = $this->em->getMetadataFactory()->getAllMetadata(Product::class);
        $schemaTool->dropSchema($metadata);
        $schemaTool->updateSchema($metadata);
    }

    public function testDependencyInjection(): void {
        $application = new Application(self::$kernel);

        $this->expectNotToPerformAssertions();
        $command = $application->find('app:aDayPasses');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }
}