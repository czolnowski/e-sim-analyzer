<?php
namespace AppBundle\Recognizer;

use AppBundle\Entity\Player;
use AppBundle\Entity\StockCompany;
use AppBundle\Entity\Trader;
use Symfony\Component\DomCrawler\Crawler;

class TraderRecognizer
{
    const PROFILE_ID_URL = 'profile.html?id=';
    const STOCK_COMPANY_ID_URL = 'stockCompany.html?id=';

    /**
     * @param Crawler $row
     * @param int $columnIndex
     * @return Trader
     */
    public function recognize(Crawler $row, $columnIndex)
    {
        $trader = new Trader();

        $traderNode = $row->filter('td')->eq($columnIndex)->filter('a');
        $traderUrl = $traderNode->attr('href');
        if (substr($traderUrl, 0, strlen(self::PROFILE_ID_URL)) === self::PROFILE_ID_URL) {
            $player = new Player();
            $player->setId((int)substr($traderUrl, strlen(self::PROFILE_ID_URL)));
            $player->setName($traderNode->text());

            $trader->setPlayer($player);
        }

        if (substr($traderUrl, 0, strlen(self::STOCK_COMPANY_ID_URL)) === self::STOCK_COMPANY_ID_URL) {
            $stockCompany = new StockCompany();
            $stockCompany->setId((int)substr($traderUrl, strlen(self::STOCK_COMPANY_ID_URL)));
            $stockCompany->setName($traderNode->text());

            $trader->setStockCompany($stockCompany);
        }

        return $trader;
    }
} 