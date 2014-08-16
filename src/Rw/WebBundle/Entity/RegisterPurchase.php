<?php

namespace Rw\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegisterPurchase
 */
class RegisterPurchase
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $addressLine01;

    /**
     * @var string
     */
    private $addressLine02;

    /**
     * @var string
     */
    private $addressCity;

    /**
     * @var string
     */
    private $addressState;

    /**
     * @var string
     */
    private $addressZip;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $chargeId;

    /**
     * @var boolean
     */
    private $chargeCvcCheck;

    /**
     * @var boolean
     */
    private $chargeAddressLine01Check;

    /**
     * @var boolean
     */
    private $chargeAddressZipCheck;

    /**
     * @var string
     */
    private $chargeCardId;

    /**
     * @var integer
     */
    private $chargeAmount;

    /**
     * @var string
     */
    private $chargeResponse;

    /**
     * @var \DateTime
     */
    private $cleanDate;

    /**
     * @var boolean
     */
    private $chargeState;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var array
     */
    private $items;

    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection;
    }

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
     * Set firstName
     *
     * @param string $fullName
     * @return RegisterPurchase
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    
        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set addressLine01
     *
     * @param string $addressLine01
     * @return RegisterPurchase
     */
    public function setAddressLine01($addressLine01)
    {
        $this->addressLine01 = $addressLine01;
    
        return $this;
    }

    /**
     * Get addressLine01
     *
     * @return string 
     */
    public function getAddressLine01()
    {
        return $this->addressLine01;
    }

    /**
     * Set addressLine02
     *
     * @param string $addressLine02
     * @return RegisterPurchase
     */
    public function setAddressLine02($addressLine02)
    {
        $this->addressLine02 = $addressLine02;
    
        return $this;
    }

    /**
     * Get addressLine02
     *
     * @return string 
     */
    public function getAddressLine02()
    {
        return $this->addressLine02;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     * @return RegisterPurchase
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;
    
        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string 
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressState
     *
     * @param string $addressState
     * @return RegisterPurchase
     */
    public function setAddressState($addressState)
    {
        $this->addressState = $addressState;
    
        return $this;
    }

    /**
     * Get addressState
     *
     * @return string 
     */
    public function getAddressState()
    {
        return $this->addressState;
    }

    /**
     * Set addressZip
     *
     * @param string $addressZip
     * @return RegisterPurchase
     */
    public function setAddressZip($addressZip)
    {
        $this->addressZip = $addressZip;
    
        return $this;
    }

    /**
     * Get addressZip
     *
     * @return string 
     */
    public function getAddressZip()
    {
        return $this->addressZip;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return RegisterPurchase
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return RegisterPurchase
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set chargeId
     *
     * @param string $chargeId
     * @return RegisterPurchase
     */
    public function setChargeId($chargeId)
    {
        $this->chargeId = $chargeId;
    
        return $this;
    }

    /**
     * Get chargeId
     *
     * @return string 
     */
    public function getChargeId()
    {
        return $this->chargeId;
    }

    /**
     * Set chargeCvcCheck
     *
     * @param boolean $chargeCvcCheck
     * @return RegisterPurchase
     */
    public function setChargeCvcCheck($chargeCvcCheck)
    {
        $this->chargeCvcCheck = $chargeCvcCheck;
    
        return $this;
    }

    /**
     * Get chargeCvcCheck
     *
     * @return boolean 
     */
    public function getChargeCvcCheck()
    {
        return $this->chargeCvcCheck;
    }

    /**
     * Set chargeAddressLine01Check
     *
     * @param boolean $chargeAddressLine01Check
     * @return RegisterPurchase
     */
    public function setChargeAddressLine01Check($chargeAddressLine01Check)
    {
        $this->chargeAddressLine01Check = $chargeAddressLine01Check;
    
        return $this;
    }

    /**
     * Get chargeAddressLine01Check
     *
     * @return boolean 
     */
    public function getChargeAddressLine01Check()
    {
        return $this->chargeAddressLine01Check;
    }

    /**
     * Set chargeAddressZipCheck
     *
     * @param boolean $chargeAddressZipCheck
     * @return RegisterPurchase
     */
    public function setChargeAddressZipCheck($chargeAddressZipCheck)
    {
        $this->chargeAddressZipCheck = $chargeAddressZipCheck;
    
        return $this;
    }

    /**
     * Get chargeAddressZipCheck
     *
     * @return boolean 
     */
    public function getChargeAddressZipCheck()
    {
        return $this->chargeAddressZipCheck;
    }

    /**
     * Set chargeCardId
     *
     * @param string $chargeCardId
     * @return RegisterPurchase
     */
    public function setChargeCardId($chargeCardId)
    {
        $this->chargeCardId = $chargeCardId;
    
        return $this;
    }

    /**
     * Get chargeCardId
     *
     * @return string 
     */
    public function getChargeCardId()
    {
        return $this->chargeCardId;
    }

    /**
     * Set chargeAmount
     *
     * @param integer $chargeAmount
     * @return RegisterPurchase
     */
    public function setChargeAmount($chargeAmount)
    {
        $this->chargeAmount = $chargeAmount;
    
        return $this;
    }

    /**
     * Get chargeAmount
     *
     * @return integer 
     */
    public function getChargeAmount()
    {
        return $this->chargeAmount;
    }

    /**
     * Set chargeResponse
     *
     * @param string $chargeResponse
     * @return RegisterPurchase
     */
    public function setChargeResponse($chargeResponse)
    {
        $this->chargeResponse = $chargeResponse;
    
        return $this;
    }

    /**
     * Get chargeResponse
     *
     * @return string 
     */
    public function getChargeResponse()
    {
        return $this->chargeResponse;
    }

    /**
     * Set cleanDate
     *
     * @param \DateTime $cleanDate
     * @return RegisterPurchase
     */
    public function setCleanDate($cleanDate)
    {
        $this->cleanDate = $cleanDate;
    
        return $this;
    }

    /**
     * Get cleanDate
     *
     * @return \DateTime 
     */
    public function getCleanDate()
    {
        return $this->cleanDate;
    }

    /**
     * Set chargeState
     *
     * @param boolean $chargeState
     * @return RegisterPurchase
     */
    public function setChargeState($chargeState)
    {
        $this->chargeState = $chargeState;
    
        return $this;
    }

    /**
     * Get chargeState
     *
     * @return boolean 
     */
    public function getChargeState()
    {
        return $this->chargeState;
    }

    /**
     * Set notes
     *
     * @param string $chargeState
     * @return RegisterPurchase
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    
        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set items
     *
     * @param string $items
     * @return RegisterPurchase
     */
    public function setItems($items)
    {
        $this->items = $items;
    
        return $this;
    }

    /**
     * Get items
     *
     * @return string
     */
    public function getItems()
    {
        return $this->items;
    }
}
