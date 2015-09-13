<?php
namespace AppBundle\Creator;

use AppBundle\Entity\JobOffer;
use AppBundle\Recognizer\CompanyRecognizer;
use AppBundle\Recognizer\ProductRecognizer;
use AppBundle\Recognizer\TraderRecognizer;
use Symfony\Component\DomCrawler\Crawler;

class JobOfferCreator
{
    /**
     * @var Crawler
     */
    private $row;

    /**
     * @var JobOffer
     */
    private $jobOffer;

    /**
     * @var TraderRecognizer
     */
    private $traderRecognizer;

    /**
     * @var ProductRecognizer
     */
    private $productRecognizer;

    /**
     * @var CompanyRecognizer
     */
    private $companyRecognizer;

    /**
     * @param TraderRecognizer $traderRecognizer
     * @param ProductRecognizer $productRecognizer
     * @param CompanyRecognizer $companyRecognizer
     */
    public function __construct(TraderRecognizer $traderRecognizer, ProductRecognizer $productRecognizer,
                                CompanyRecognizer $companyRecognizer)
    {
        $this->traderRecognizer = $traderRecognizer;
        $this->productRecognizer = $productRecognizer;
        $this->companyRecognizer = $companyRecognizer;
        $this->jobOffer = new JobOffer();
    }

    /**
     * @param Crawler $row
     * @return JobOfferCreator
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @return JobOffer
     */
    public function getJobOffer()
    {
        return $this->jobOffer;
    }

    /**
     * @return JobOfferCreator
     */
    public function recognizeAndAssignEmployer()
    {
        $this->jobOffer->setTrader(
            $this->traderRecognizer->recognize($this->row, 0)
        );

        return $this;
    }

    /**
     * @return JobOfferCreator
     */
    public function assignCompany()
    {
        $company = $this->companyRecognizer->recognize($this->row, 1);

        $company->setProduct(
            $this->productRecognizer->recognizeType($this->row, 2, 0)
        );

        $company->setQuality(
            $this->productRecognizer->recognizeQuality($this->row, 2, 1)
        );

        $this->jobOffer->setCompany($company);

        return $this;
    }

    /**
     * @return JobOfferCreator
     */
    public function assignSkill()
    {
        $this->jobOffer->setSkill(
            (float) $this->row->filter('td')->eq(3)->text()
        );

        return $this;
    }

    /**
     * @return JobOfferCreator
     */
    public function assignSalary()
    {
        $this->jobOffer->setSalary(
            (float) $this->row->filter('td')->eq(4)->filter('b')->text()
        );

        return $this;
    }
} 