<?php
namespace AppBundle\Fetcher;

use AppBundle\Entity\Country;
use Symfony\Component\DomCrawler\Crawler;

class JobMarketFetcher extends AbstractFetcher
{
    /**
     * @param int $skill
     * @param Country $country
     * @param int $page
     * @return Crawler
     */
    public function getCrawler($skill, Country $country, $page)
    {
        return $this->getCrawlerInstance(
            sprintf(
                'jobMarket.html?countryId=%d&minimalSkill=%d&page=%d',
                $country->getId(),
                $skill,
                $page
            )
        );
    }
} 