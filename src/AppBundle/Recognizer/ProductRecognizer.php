<?php
namespace AppBundle\Recognizer;

use Symfony\Component\DomCrawler\Crawler;

class ProductRecognizer
{
    /**
     * @param Crawler $row
     * @param int $columnIndex
     * @param int $srcIndex
     * @return string
     */
    public function recognizeType(Crawler $row, $columnIndex, $srcIndex)
    {
        $split = explode('/', $this->getProductNodes($row, $columnIndex)->eq($srcIndex)->attr('src'));
        $lastElement = $split[count($split) - 1];

        return strtolower(
            substr(
                $lastElement,
                0,
                strpos($lastElement, '.')
            )
        );
    }

    /**
     * @param Crawler $row
     * @param int $columnIndex
     * @param int $srcIndex
     * @return int
     */
    public function recognizeQuality(Crawler $row, $columnIndex, $srcIndex)
    {
        $split = explode('/', $this->getProductNodes($row, $columnIndex)->eq($srcIndex)->attr('src'));

        return (int) substr(
            $split[count($split) - 1],
            1,
            2
        );
    }

    /**
     * @param Crawler $row
     * @param $columnIndex
     * @return Crawler
     */
    private function getProductNodes(Crawler $row, $columnIndex)
    {
        return $row->filter('td')->eq($columnIndex)->filter('img');
    }
} 