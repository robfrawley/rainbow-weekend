<?php

namespace Rw\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rw\WebBundle\Entity\RegisterItemGroup;

/**
 * RegisterItem
 */
class RegisterItem
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
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $costDonation;

    /**
     * @var integer
     */
    private $costDollars;

    /**
     * @var integer
     */
    private $costCents;

    /**
     * @var \DateTime
     */
    private $datetimeStart;

    /**
     * @var \DateTime
     */
    private $datetimeEnd;

    /**
     * @var string
     */
    private $dateformatStart;

    /**
     * @var string
     */
    private $dateformatEnd;

    /**
     * @var \DateTime
     */
    private $datetimeLaunch;

    /**
     * @var \DateTime
     */
    private $datetimeCutoff;

    /**
     * @var string
     */
    private $statementDescription;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var int
     */
    private $group;

    /**
     * @var array
     */
    private $metadata;

    /**
     * @var bool
     */
    private $presale;

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
     * @return RegisterItem
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
     * Set presale
     *
     * @param bool $presale
     * @return RegisterItem
     */
    public function setPresale($presale)
    {
        $this->presale = $presale;
    
        return $this;
    }

    /**
     * Get presale
     *
     * @return bool|null
     */
    public function getPresale()
    {
        return $this->presale;
    }

    /**
     * Is presale
     *
     * @retrun bool
     */
    public function isPresale()
    {
        if ($this->presale !== null && $this->presale === true) {
            return true;
        }

        return false;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return RegisterItem
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set costDonation
     *
     * @param bool $costDonation
     * @return RegisterItem
     */
    public function setCostDonation($costDonation)
    {
        $this->costDonation = $costDonation;

        return $this;
    }

    /**
     * Get costDonation
     *
     * @return string
     */
    public function getCostDonation()
    {
        return $this->costDonation;
    }

    /**
     * Set costDollars
     *
     * @param integer $costDollars
     * @return RegisterItem
     */
    public function setCostDollars($costDollars)
    {
        $this->costDollars = $costDollars;
    
        return $this;
    }

    /**
     * Get costDollars
     *
     * @return integer 
     */
    public function getCostDollars()
    {
        return $this->costDollars;
    }

    /**
     * Set costCents
     *
     * @param integer $costCents
     * @return RegisterItem
     */
    public function setCostCents($costCents)
    {
        $this->costCents = $costCents;
    
        return $this;
    }

    /**
     * Get costCents
     *
     * @return integer 
     */
    public function getCostCents()
    {
        return $this->costCents;
    }

    /**
     * Set datetimeStart
     *
     * @param \DateTime $datetimeStart
     * @return RegisterItem
     */
    public function setDatetimeStart($datetimeStart)
    {
        $this->datetimeStart = $datetimeStart;
    
        return $this;
    }

    /**
     * Get datetimeStart
     *
     * @return \DateTime 
     */
    public function getDatetimeStart()
    {
        return $this->datetimeStart;
    }

    /**
     * Set datetimeEnd
     *
     * @param \DateTime $datetimeEnd
     * @return RegisterItem
     */
    public function setDatetimeEnd($datetimeEnd)
    {
        $this->datetimeEnd = $datetimeEnd;
    
        return $this;
    }

    /**
     * Get datetimeEnd
     *
     * @return \DateTime 
     */
    public function getDatetimeEnd()
    {
        return $this->datetimeEnd;
    }

    /**
     * Set dateformatStart
     *
     * @param string $dateformatStart
     * @return RegisterItem
     */
    public function setDateformatStart($dateformatStart)
    {
        $this->dateformatStart = $dateformatStart;
    
        return $this;
    }

    /**
     * Get dateformatStart
     *
     * @return string 
     */
    public function getDateformatStart()
    {
        return $this->dateformatStart;
    }

    /**
     * Set dateformatEnd
     *
     * @param string $dateformatEnd
     * @return RegisterItem
     */
    public function setDateformatEnd($dateformatEnd)
    {
        $this->dateformatEnd = $dateformatEnd;
    
        return $this;
    }

    /**
     * Get dateformatEnd
     *
     * @return string 
     */
    public function getDateformatEnd()
    {
        return $this->dateformatEnd;
    }


    /**
     * Set datetimeLaunch
     *
     * @param \DateTime $datetimeLaunch
     * @return RegisterItem
     */
    public function setDatetimeLaunch($datetimeLaunch)
    {
        $this->datetimeLaunch = $datetimeLaunch;
    
        return $this;
    }

    /**
     * Get datetimeLaunch
     *
     * @return \DateTime 
     */
    public function getDatetimeLaunch()
    {
        return $this->datetimeLaunch;
    }

    /**
     * Set datetimeCutoff
     *
     * @param \DateTime $datetimeCutoff
     * @return RegisterItem
     */
    public function setDatetimeCutoff($datetimeCutoff)
    {
        $this->datetimeCutoff = $datetimeCutoff;
    
        return $this;
    }

    /**
     * Get datetimeCutoff
     *
     * @return \DateTime 
     */
    public function getDatetimeCutoff()
    {
        return $this->datetimeCutoff;
    }

    /**
     * Set statementDescription
     *
     * @param string $statementDescription
     * @return RegisterItem
     */
    public function setStatementDescription($statementDescription)
    {
        $this->statementDescription = $statementDescription;

        return $this;
    }

    /**
     * Get statementDescription
     *
     * @return string
     */
    public function getStatementDescription()
    {
        return $this->statementDescription;
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
     * Set group
     *
     * @param RegisterItemGroup $group
     * @return RegisterItem
     */
    public function setGroup(RegisterItemGroup $group)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return RegisterItemGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set metadata
     *
     * @param array $metadata
     * @return RegisterItem
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * Get metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
