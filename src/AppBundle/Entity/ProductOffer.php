<?php
namespace AppBundle\Entity;

use DateTime;

class ProductOffer implements Populate
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var Trader
     */
    private $trader;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var float
     */
    private $price;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
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
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
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