<?php
namespace AppBundle\Fetcher;

use AppBundle\Entity\Country;
use AppBundle\ESim\Client;
use GuzzleHttp;
use Symfony\Component\DomCrawler\Crawler;

class CountriesFetcher
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
     * @return Country[]
     */
    public function get()
    {
        $crawler = new Crawler(
            $this->client->get('jobMarket.html')->getBody()->getContents()
        );

        $countries = [];
        $crawler->filter('#jobMarketForm select option')->each(
            function (Crawler $node) use (&$countries) {
                $country = new Country();
                $country->setId((int)$node->attr('value'));
                $country->setName($node->text());

                $countries[] = $country;
            }
        );

        return $countries;
    }
} 