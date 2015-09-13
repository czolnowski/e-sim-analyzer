<?php
namespace AppBundle\Configuration;

class FetcherConfiguration
{
    /**
     * @var int
     */
    private $amountOfColumns;

    /**
     * @var string
     */
    private $firstColumnLabel;

    /**
     * @return int
     */
    public function getAmountOfColumns()
    {
        return $this->amountOfColumns;
    }

    /**
     * @param int $amountOfColumns
     */
    public function setAmountOfColumns($amountOfColumns)
    {
        $this->amountOfColumns = (int) $amountOfColumns;
    }

    /**
     * @return string
     */
    public function getFirstColumnLabel()
    {
        return $this->firstColumnLabel;
    }

    /**
     * @param string $firstColumnLabel
     */
    public function setFirstColumnLabel($firstColumnLabel)
    {
        $this->firstColumnLabel = $firstColumnLabel;
    }
}