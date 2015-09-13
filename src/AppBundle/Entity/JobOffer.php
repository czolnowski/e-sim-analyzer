<?php
namespace AppBundle\Entity;

use DateTime;

class JobOffer implements Populate
{
    /**
     * @var Trader
     */
    private $trader;

    /**
     * @var Company
     */
    private $company;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var int
     */
    private $skill;

    /**
     * @var float
     */
    private $salary;

    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
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

    /**
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return int
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * @param int $skill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
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
} 