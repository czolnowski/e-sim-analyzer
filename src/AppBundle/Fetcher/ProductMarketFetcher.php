<?php
namespace AppBundle\Fetcher;

use AppBundle\Entity\Country;
use Symfony\Component\DomCrawler\Crawler;

class ProductMarketFetcher extends AbstractFetcher
{
    /**
     * @param Country $country
     * @param int $page
     * @return Crawler
     */
    public function getCrawler(Country $country, $page)
    {
        return $this->getCrawlerInstance(
            sprintf(
                'productMarket.html?countryId=%d&quality=0&page=%d',
                $country->getId(),
                $page
            )
        );
    }
} 