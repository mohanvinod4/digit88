<?php

/**
 * Food item Category entity.
 *
 * @author Vinod M
 *
 * @category Entity
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OrderItemRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\EntityListeners({})
 */
class OrderItem 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
           
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="order_details")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;
    
    /**
     * @ORM\ManyToOne(targetEntity="FoodItem", inversedBy="order_item")
     * @ORM\JoinColumn(name="food_item_id", referencedColumnName="id")
     */
    private $food_item;
    
    /**
     * @ORM\Column(type="decimal", nullable=true, precision=12, scale=2)
     */
    private $price;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_updated_date;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_date_time;
        
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $dateTime = new \DateTime();
        $this->created_date_time = $dateTime;
        $this->last_updated_date_time = $dateTime;
    }
        
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $dateTime = new \DateTime();
        $this->last_updated_date_time = $dateTime;
    }

    /**
     * Set lastUpdatedDate
     *
     * @param \DateTime $lastUpdatedDate
     *
     * @return User
     */
    public function setLastUpdatedDate($lastUpdatedDate)
    {
        $this->last_updated_date = $lastUpdatedDate;

        return $this;
    }

    /**
     * Get lastUpdatedDate
     *
     * @return \DateTime
     */
    public function getLastUpdatedDate()
    {
        return $this->last_updated_date;
    }

    /**
     * Set createdDateTime
     *
     * @param \DateTime $createdDateTime
     *
     * @return User
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->created_date_time = $createdDateTime;

        return $this;
    }

    /**
     * Get createdDateTime
     *
     * @return \DateTime
     */
    public function getCreatedDateTime()
    {
        return $this->created_date_time;
    }
}
