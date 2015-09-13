<?php
namespace AppBundle\Creator;

use AppBundle\Recognizer\CompanyRecognizer;
use AppBundle\Recognizer\ProductRecognizer;
use AppBundle\Recognizer\TraderRecognizer;

class CreatorsFactory
{
    /**
     * @param TraderRecognizer $traderRecognizer
     * @param ProductRecognizer $productRecognizer
     * @param CompanyRecognizer $companyRecognizer
     * @return JobOfferCreator
     */
    public static function createJobOffer(TraderRecognizer $traderRecognizer, ProductRecognizer $productRecognizer,
                                  CompanyRecognizer $companyRecognizer)
    {
        return new JobOfferCreator($traderRecognizer, $productRecognizer, $companyRecognizer);
    }

    /**
     * @param TraderRecognizer $traderRecognizer
     * @return CurrencyRatioCreator
     */
    public static function createCurrencyRatio(TraderRecognizer $traderRecognizer)
    {
        return new CurrencyRatioCreator($traderRecognizer);
    }


    /**
     * @param TraderRecognizer $traderRecognizer
     * @param ProductRecognizer $productRecognizer
     * @return ProductOfferCreator
     */
    public static function createProductOffer(TraderRecognizer $traderRecognizer, ProductRecognizer $productRecognizer)
    {
        return new ProductOfferCreator($traderRecognizer, $productRecognizer);
    }
} 