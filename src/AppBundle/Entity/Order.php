<?php

/**
 * Order entity.
 *
 * @author Vinod M
 *
 * @category Entity
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\OrderRepository")
 * @ORM\Table(name="order_details")
 * @ORM\HasLifecycleCallbacks
 * @ORM\EntityListeners({})
 */
class Order 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
        
    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    private $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="order")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\Column(type="decimal", nullable=true, precision=12, scale=2)
     */
    private $total_cost;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_updated_date;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_date_time;
    
    /**
     * @ORM\OneToMany(targetEntity="OrderItem", mappedBy="order")
     */
    private $orderDetails;
    
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
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderDetails = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set status
     *
     * @param integer $status
     *
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set totalCost
     *
     * @param string $totalCost
     *
     * @return Order
     */
    public function setTotalCost($totalCost)
    {
        $this->total_cost = $totalCost;

        return $this;
    }

    /**
     * Get totalCost
     *
     * @return string
     */
    public function getTotalCost()
    {
        return $this->total_cost;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Order
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add orderDetail
     *
     * @param \AppBundle\Entity\OrderItem $orderDetail
     *
     * @return Order
     */
    public function addOrderDetail(\AppBundle\Entity\OrderItem $orderDetail)
    {
        $this->orderDetails[] = $orderDetail;

        return $this;
    }

    /**
     * Remove orderDetail
     *
     * @param \AppBundle\Entity\OrderItem $orderDetail
     */
    public function removeOrderDetail(\AppBundle\Entity\OrderItem $orderDetail)
    {
        $this->orderDetails->removeElement($orderDetail);
    }

    /**
     * Get orderDetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }
}
