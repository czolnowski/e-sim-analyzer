<?php
namespace AppBundle\Entity;

class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $raw = false;

    /**
     * @var int
     */
    private $quality;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;

        if (in_array($this->name, array('iron', 'grain', 'oil', 'stone', 'wood', 'diamonds'), true)) {
            $this->setRaw(true);
        }
    }

    /**
     * @return int
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * @param int $quality
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
    }

    /**
     * @return boolean
     */
    public function isRaw()
    {
        return $this->raw;
    }

    /**
     * @param boolean $raw
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;
    }
} 