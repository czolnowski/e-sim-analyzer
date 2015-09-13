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
        $jobOffersFetcher = $this->getApplication()->find('app:job-offers:fetch');
        $monetaryMarketFetcher = $this->getApplication()->find('app:monetary-market:fetch');
        $productMarketFetcher = $this->getApplication()->find('app:product-market:fetch');

        $jobOffersFetcher->run($input, $output);
        $monetaryMarketFetcher->run($input, $output);
        $productMarketFetcher->run($input, $output);
    }
} 