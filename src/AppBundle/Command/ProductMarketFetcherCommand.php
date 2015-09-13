<?php
namespace AppBundle\Command;

use AppBundle\Creator\ProductOfferCreator;
use AppBundle\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp;
use Symfony\Component\DomCrawler\Crawler;

class ProductMarketFetcherCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName('app:product-market:fetch');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $fetcher = $container->get('app.fetcher.product_offers');
        $populate = $container->get('app.service.collection_populate.product_offers');

        $productOfferCreator = function (Country $country) use ($container) {
            $productOfferCreator = $container->get('app.creator.product_offer');
            $productOfferCreator->getProductOffer()->setCountry($country);

            return $productOfferCreator;
        };

        foreach ($container->get('app.fetcher.countries')->get() as $country) {
            $pages = 1;
            for ($page = 0; $page < $pages; ++$page) {
                $output->writeln(
                    sprintf(
                        '<comment>[page %d]</comment> Fetch products for %s. ',
                        $page + 1,
                        $country->getName()
                    )
                );

                $crawler = $fetcher->getCrawler($country, $page);
                if ($fetcher->isEmptyResult($crawler)) {
                    $output->writeln('<error>Not found products.</error>');

                    continue;
                }

                if ($page === 0) {
                    $pages = $fetcher->getAmountOfPages($crawler);
                }

                $fetcher->getRows($crawler)->each(
                /**
                 * @param Crawler $row
                 */
                    function (Crawler $row) use ($country, $fetcher, $populate, $productOfferCreator) {
                        if ($fetcher->isHeaderRow($row)) {
                            return;
                        }

                        /**
                         * @var ProductOfferCreator $creator
                         */
                        $creator = $productOfferCreator($country)
                            ->setRow($row)
                            ->recognizeProduct()
                            ->recognizeAndAssignTrader()
                            ->assignAmount()
                            ->assignPrice();

                        $populate->collect($creator->getProductOffer());
                    }
                );
            }

            $output->writeln(
                sprintf('<info>Fetched %d products for %s.</info>', $populate->getSize(), $country->getName())
            );

            $populate->populate();
        }
    }
} 