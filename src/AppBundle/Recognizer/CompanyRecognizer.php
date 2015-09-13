<?php
namespace AppBundle\Recognizer;

use AppBundle\Entity\Company;
use Symfony\Component\DomCrawler\Crawler;

class CompanyRecognizer
{
    const COMPANY_ID_URL = 'company.html?id=';

    /**
     * @param Crawler $row
     * @param int $columnIndex
     * @return Company
     */
    public function recognize(Crawler $row, $columnIndex)
    {
        $company = new Company();

        $companyNode = $row->filter('td')->eq($columnIndex)->filter('a');
        $companyUrl = $companyNode->attr('href');
        if (substr($companyUrl, 0, strlen(self::COMPANY_ID_URL)) === self::COMPANY_ID_URL) {
            $company->setId((int)substr($companyUrl, strlen(self::COMPANY_ID_URL)));
            $company->setName($companyNode->text());
        }

        return $company;
    }
} 