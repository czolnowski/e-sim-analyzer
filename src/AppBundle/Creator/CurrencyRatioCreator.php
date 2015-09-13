<?php
namespace AppBundle\Creator;

use AppBundle\Entity\CurrencyRatio;
use AppBundle\Recognizer\TraderRecognizer;
use Symfony\Component\DomCrawler\Crawler;

class CurrencyRatioCreator
{
    /**
     * @var Crawler
     */
    private $row;

    /**
     * @var CurrencyRatio
     */
    private $currencyRatio;

    /**
     * @var TraderRecognizer
     */
    private $traderRecognizer;

    /**
     * @param TraderRecognizer $traderRecognizer
     */
    public function __construct(TraderRecognizer $traderRecognizer)
    {
        $this->traderRecognizer = $traderRecognizer;
        $this->currencyRatio = new CurrencyRatio();
    }

    /**
     * @param Crawler $row
     * @return CurrencyRatioCreator
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @return CurrencyRatio
     */
    public function getCurrencyRatio()
    {
        return $this->currencyRatio;
    }

    /**
     * @return CurrencyRatioCreator
     */
    public function recognizeAndAssignTrader()
    {
        $this->currencyRatio->setTrader(
            $this->traderRecognizer->recognize($this->row, 0)
        );

        return $this;
    }

    /**
     * @return CurrencyRatioCreator
     */
    public function assignAmount()
    {
        $this->currencyRatio->setAmount(
            (float) $this->row->filter('td')->eq(1)->filter('b')->attr('title')
        );

        return $this;
    }

    /**
     * @return CurrencyRatioCreator
     */
    public function assignRatio()
    {
        $this->currencyRatio->setRatio(
            (float) $this->row->filter('td')->eq(2)->filter('b')->text()
        );

        return $this;
    }
} 