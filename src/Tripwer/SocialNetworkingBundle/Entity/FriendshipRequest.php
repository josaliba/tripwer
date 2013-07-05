<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FriendshipRequest
 * @ORM\Table(name="socialnetworking__friendship_requests")
 * @ORM\Entity(repositoryClass="Tripwer\SocialNetworkingBundle\Entity\Repository\FriendshipRequestRepository")
 * @Gedmo\SoftDeleteable(fieldName="cancelDate")
 */
class FriendshipRequest
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
     * The user that sent the request
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="from_member_id", nullable=false)
     * @var Member $sender
     */
    private $sender;

    /**
     * The user which the request is sent to
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="to_member_id", nullable=false)
     * @var Member $receiver
     */
    private $receiver;

    /**
     * Indicates if member answered the request
     * @var bool
     * @ORM\Column(name="answered", type="boolean", nullable=false)
     */
    private $answered = false;

    /**
     * Indicates if member has accepted the request or not
     * @var bool
     * @ORM\Column(name="accepted", type="boolean", nullable=false)
     */
    private $accepted = false;

    /**
     * The date when the request was initiated
     * @var \DateTime
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private $createDate;

    /**
     * The date when the request was initiated
     * @var \DateTime
     * @ORM\Column(name="answer_date", type="datetime", nullable=true)
     */
    private $answerDate = null;

    /**
     * @var \DateTime
     * @ORM\Column(name="cancel_date", type="datetime", nullable=true)
     */
    private $cancelDate = null;

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
     * @param boolean $accepted
     * @return FriendshipRequest
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param boolean $answered
     * @return FriendshipRequest
     */
    public function setAnswered($answered)
    {
        $this->answered = $answered;
        if ($answered){
            $this->answerDate = new \DateTime();
        }
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAnswered()
    {
        return $this->answered;
    }

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $sender
     * @return FriendshipRequest
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $receiver
     * @return FriendshipRequest
     */
    public function setTo($receiver)
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
     * @param \DateTime $answerDate
     * @return FriendshipRequest
     */
    public function setAnswerDate($answerDate)
    {
        $this->answerDate = $answerDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAnswerDate()
    {
        return $this->answerDate;
    }

    /**
     * @param \DateTime $createDate
     * @return FriendshipRequest
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getCanceledDate(){
        return $this->cancelDate;
    }

    /**
     * @return bool
     */
    public function isCanceled(){
        if ($this->cancelDate)
            return true;
        return false;
    }
}
