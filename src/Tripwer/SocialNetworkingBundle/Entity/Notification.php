<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Tripwer\SocialNetworkingBundle\Entity\Member;

/**
 * Notification
 *
 * @ORM\Table(name="socialnetworking__notifications")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *      "friendship_request_created" = "Tripwer\SocialNetworkingBundle\Entity\Notifications\FriendshipRequestCreatedNotification",
 *      "friendship_request_accepted" = "Tripwer\SocialNetworkingBundle\Entity\Notifications\FriendshipRequestAcceptedNotification"
 *
 * })
 * @Gedmo\SoftDeleteable(fieldName="deleteDate")
 */
abstract class Notification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $createDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="viewed", type="boolean")
     */
    private $viewed;

    /**
     * @var Member
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="receiver_id",nullable=false)
     *
     */
    private $receiver;

    /**
     * @var \DateTime $deleteDate
     * @ORM\Column(type="datetime",name="delete_date",nullable=true)
     */
    private $deleteDate = null;


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
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return Notification
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set viewed
     *
     * @param boolean $viewed
     * @return Notification
     */
    public function setViewed($viewed)
    {
        $this->viewed = $viewed;
    
        return $this;
    }

    /**
     * Get viewed
     *
     * @return boolean 
     */
    public function getViewed()
    {
        return $this->viewed;
    }

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $receiver
     * @return Notification
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param \DateTime $deleteDate
     * @return Notification
     */
    public function setDeleteDate($deleteDate)
    {
        $this->deleteDate = $deleteDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeleteDate()
    {
        return $this->deleteDate;
    }




}
