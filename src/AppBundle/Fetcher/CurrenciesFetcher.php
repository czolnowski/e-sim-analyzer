<?php
namespace AppBundle\Fetcher;

use AppBundle\Entity\Currency;
use AppBundle\ESim\Client;
use Symfony\Component\DomCrawler\Crawler;

class CurrenciesFetcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Currency[]
     */
    public function get()
    {
        $crawler = new Crawler(
            $this->client->get('monetaryMarket.html')->getBody()->getContents()
        );

        $currencies = [];
        $crawler->filter('#monetaryMarketView select option')->each(
            function (Crawler $node) use (&$currencies) {
                $currency = new Currency();
                $currency->setId((int)$node->attr('value'));
                $currency->setName($node->text());

                // skip gold
                if ($currency->getId() < 1) {
                    return;
                }

                $currencies[] = $currency;
            }
        );

        return $currencies;
    }
} 