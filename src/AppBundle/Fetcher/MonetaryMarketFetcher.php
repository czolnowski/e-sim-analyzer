<?php
namespace AppBundle\Fetcher;

use AppBundle\Entity\Currency;
use Symfony\Component\DomCrawler\Crawler;

class MonetaryMarketFetcher extends AbstractFetcher
{
    /**
     * @param string $state
     * @param Currency $currency
     * @param int $page
     * @return Crawler
     */
    public function getCrawler($state, Currency $currency, $page)
    {
        return $this->getCrawlerInstance(
            sprintf(
                'monetaryMarket.html?buyerCurrencyId=%d&sellerCurrencyId=%d&page=%d',
                $state === 'buy' ? $currency->getId() : 0,
                $state === 'buy' ? 0 : $currency->getId(),
                $page
            )
        );
    }
} 