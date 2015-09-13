<?php
namespace AppBundle\Command;

use AppBundle\Creator\CurrencyRatioCreator;
use AppBundle\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp;
use Symfony\Component\DomCrawler\Crawler;

class MonetaryMarketFetcherCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('app:monetary-market:fetch');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $fetcher = $container->get('app.fetcher.monetary_market');
        $populate = $container->get('app.service.collection_populate.currency_ratio');

        $currencyRatioCreator = function (Currency $currency, $state) use ($container) {
            $currencyRatioCreator = $container->get('app.creator.currency_ratio');
            $currencyRatioCreator->getCurrencyRatio()->setCurrency($currency);
            $currencyRatioCreator->getCurrencyRatio()->setState($state);

            return $currencyRatioCreator;
        };

        foreach ($container->get('app.fetcher.currencies')->get() as $currency) {
            foreach (['buy', 'sell'] as $state) {
                $pages = 1;
                for ($page = 0; $page < $pages; ++$page) {
                    $output->writeln(
                        sprintf(
                            '<comment>[%s]</comment><comment>[page %d]</comment> Fetch %s currency. ',
                            $state === 'buy' ? 'buying' : 'selling',
                            $page + 1,
                            $currency->getName()
                        )
                    );

                    $crawler = $fetcher->getCrawler($state, $currency, $page);
                    if ($fetcher->isEmptyResult($crawler)) {
                        $output->writeln('<error>Not found rates.</error>');

                        continue;
                    }

                    if ($page === 0) {
                        $pages = $fetcher->getAmountOfPages($crawler);
                    }

                    $fetcher->getRows($crawler)->each(
                        function (Crawler $row) use ($currency, $state, $fetcher, $populate, $currencyRatioCreator) {
                            if ($fetcher->isHeaderRow($row)) {
                                return;
                            }

                            /**
                             * @var CurrencyRatioCreator $creator
                             */
                            $creator = $currencyRatioCreator($currency, $state)
                                ->setRow($row)
                                ->recognizeAndAssignTrader()
                                ->assignAmount()
                                ->assignRatio();

                            $populate->collect($creator->getCurrencyRatio());
                        }
                    );
                }

                $output->writeln(
                    sprintf('<info>Fetched %d rates for %s.</info>', $populate->getSize(), $currency->getName())
                );

                $populate->populate();
            }
        }
    }
} 