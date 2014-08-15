<?php

namespace Rw\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegisterItemGroup
 */
class RegisterItemGroup
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var array
     */
    private $items;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return RegisterItemGroup
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set weight
     *
     * @param int $weight
     * @return RegisterItem
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set items
     *
     * @param array $items
     * @return RegisterItem
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    public function getItemsCurrent()
    {
        $now     = new \Datetime;
        $all     = $this->items;
        $current = [];

        foreach ($all as $item) {
            if ($item->getDatetimeLaunch() < $now && $item->getDatetimeCutoff() > $now) {
                $current[] = $item;
            }
        }

        return $current;
    }
}
