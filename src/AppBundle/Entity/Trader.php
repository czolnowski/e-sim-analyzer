<?php
namespace AppBundle\Entity;

class Trader
{
    /**
     * @var Player
     */
    private $player;

    /**
     * @var StockCompany
     */
    private $stockCompany;

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return StockCompany
     */
    public function getStockCompany()
    {
        return $this->stockCompany;
    }

    /**
     * @param StockCompany $stockCompany
     */
    public function setStockCompany($stockCompany)
    {
        $this->stockCompany = $stockCompany;
    }
} 