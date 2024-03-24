<?php

namespace App\Command;

use App\Module\GildedRose\UseCase\UpdateProductsAfterADayPasses;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:aDayPasses',
    description: 'Add a short description for your command',
)]
class ADayPassesCommand extends Command
{
    public function __construct(private UpdateProductsAfterADayPasses $updateProductsAfterADayPasses)
    {
        parent::__construct();
    }

//    protected function configure(): void
//    {
//        $this->productRepository->productsIterable();
//        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
//    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->updateProductsAfterADayPasses->__invoke();
        return Command::SUCCESS;
    }
}
