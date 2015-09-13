<?php
namespace AppBundle\Fetcher;

use AppBundle\Configuration\FetcherConfiguration;
use AppBundle\ESim\Client;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractFetcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var FetcherConfiguration
     */
    private $configuration;

    /**
     * @param Client $client
     * @param FetcherConfiguration $configuration
     */
    public function __construct(Client $client, FetcherConfiguration $configuration)
    {
        $this->client = $client;
        $this->configuration = $configuration;
    }

    /**
     * @param string $url
     * @return Crawler
     */
    public function getCrawlerInstance($url)
    {
        usleep(mt_rand(500000, 2000000));

        return new Crawler(
            $this->client->get($url)->getBody()->getContents()
        );
    }

    /**
     * @param Crawler $crawler
     * @return bool
     */
    public function isEmptyResult(Crawler $crawler)
    {
        $amountOfColumns = $crawler->filter('#container table tr')->eq(1)->filter('td')->count();

        return $amountOfColumns !== $this->configuration->getAmountOfColumns();
    }

    /**
     * @param Crawler $crawler
     * @return int
     */
    public function getAmountOfPages(Crawler $crawler)
    {
        $pagination = $crawler->filter('#container #pagination-digg');
        if ($pagination->count() > 0) {
            return (int) $crawler->filter('#pagination-digg li[class!="next"]')->last()->text();
        }

        return 1;
    }

    /**
     * @param Crawler $crawler
     * @return Crawler
     */
    public function getRows(Crawler $crawler)
    {
        return $crawler->filter('#container table tr');
    }

    /**
     * @param Crawler $row
     * @return bool
     */
    public function isHeaderRow(Crawler $row)
    {
        return $row->filter('td')->first()->text() === $this->configuration->getFirstColumnLabel();
    }
} 