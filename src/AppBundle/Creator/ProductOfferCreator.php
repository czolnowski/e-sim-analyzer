<?php
namespace AppBundle\Creator;

use AppBundle\Entity\JobOffer;
use AppBundle\Entity\Price;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductOffer;
use AppBundle\Recognizer\CompanyRecognizer;
use AppBundle\Recognizer\ProductRecognizer;
use AppBundle\Recognizer\TraderRecognizer;
use Symfony\Component\DomCrawler\Crawler;

class ProductOfferCreator
{
    /**
     * @var Crawler
     */
    private $row;

    /**
     * @var ProductOffer
     */
    private $productOffer;

    /**
     * @var TraderRecognizer
     */
    private $traderRecognizer;

    /**
     * @var ProductRecognizer
     */
    private $productRecognizer;

    /**
     * @param TraderRecognizer $traderRecognizer
     * @param ProductRecognizer $productRecognizer
     */
    public function __construct(TraderRecognizer $traderRecognizer, ProductRecognizer $productRecognizer)
    {
        $this->traderRecognizer = $traderRecognizer;
        $this->productRecognizer = $productRecognizer;
        $this->productOffer = new ProductOffer();
    }

    /**
     * @param Crawler $row
     * @return ProductOfferCreator
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @return ProductOffer
     */
    public function getProductOffer()
    {
        return $this->productOffer;
    }

    /**
     * @return ProductOfferCreator
     */
    public function recognizeProduct()
    {
        $product = new Product();
        $product->setName(
            $this->productRecognizer->recognizeType($this->row, 0, 0)
        );

        if (!$product->isRaw()) {
            $this->productRecognizer->recognizeType($this->row, 0, 1);
        }

        return $this;
    }

    /**
     * @return ProductOfferCreator
     */
    public function recognizeAndAssignTrader()
    {
        $this->productOffer->setTrader(
            $this->traderRecognizer->recognize($this->row, 1)
        );

        return $this;
    }

    /**
     * @return ProductOfferCreator
     */
    public function assignAmount()
    {
        $this->productOffer->setAmount(
            (int) $this->row->filter('td')->eq(2)->text()
        );

        return $this;
    }

    /**
     * @return ProductOfferCreator
     */
    public function assignPrice()
    {
        $this->productOffer->setPrice(
            (float) $this->row->filter('td')->eq(3)->filter('b')->text()
        );

        return $this;
    }
} 