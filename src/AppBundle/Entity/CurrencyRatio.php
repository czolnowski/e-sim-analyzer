<?php
namespace AppBundle\Entity;

use DateTime;

class CurrencyRatio implements Populate
{
    /**
     * @var Trader
     */
    private $trader;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $ratio;

    /**
     * @var string
     */
    private $state;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return Trader
     */
    public function getTrader()
    {
        return $this->trader;
    }

    /**
     * @param Trader $trader
     */
    public function setTrader($trader)
    {
        $this->trader = $trader;
    }

    /**
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param float $ratio
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
} 