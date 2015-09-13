<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllFetcherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:all:fetch');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $jobOffersFetcher = new JobOffersFetcherCommand();
        $jobOffersFetcher->setContainer($this->getContainer());

        $monetaryMarketFetcher = new MonetaryMarketFetcherCommand();
        $monetaryMarketFetcher->setContainer($this->getContainer());

        $productMarketFetcher = new ProductMarketFetcherCommand();
        $productMarketFetcher->setContainer($this->getContainer());

        $jobOffersFetcher->execute($input, $output);
        $monetaryMarketFetcher->execute($input, $output);
        $productMarketFetcher->execute($input, $output);
    }
} 