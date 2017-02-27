<?php

/**
 * User entity.
 *
 * @author Vinod M
 *
 * @category Entity
 */
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\EntityListeners({})
 * @ORM\AttributeOverrides(
 * {
 *     @ORM\AttributeOverride(name="username", column=@ORM\Column(length=16, name="initiator", nullable=false)),
 *     @ORM\AttributeOverride(name="password", column=@ORM\Column(name="pin", nullable=false)),
 *     @ORM\AttributeOverride(name="email", column=@ORM\Column(nullable=true)),
 *     @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(nullable=true))
 * }
 * )
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_activity_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $last_updated_date;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_date_time;

    public function __toString()
    {
        return $this->username;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $dateTime = new \DateTime();
        $this->created_date_time = $dateTime;
        $this->last_activity_date_time = $dateTime;
    }
        
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $dateTime = new \DateTime();
        $this->last_updated_date_time = $dateTime;
        $this->last_activity_date_time = $dateTime;
    }

    /**
     * Set lastActivityDate
     *
     * @param \DateTime $lastActivityDate
     *
     * @return User
     */
    public function setLastActivityDate($lastActivityDate)
    {
        $this->last_activity_date = $lastActivityDate;

        return $this;
    }

    /**
     * Get lastActivityDate
     *
     * @return \DateTime
     */
    public function getLastActivityDate()
    {
        return $this->last_activity_date;
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
