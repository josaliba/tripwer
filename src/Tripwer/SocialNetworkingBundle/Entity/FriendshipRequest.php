<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * FriendshipRequest
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deleteDate")
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
     * @ORM\OneToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="from_member_id", nullable=false)
     * @var Member $from
     */
    private $from;

    /**
     * The user which the request is sent to
     * @ORM\OneToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="to_member_id", nullable=false)
     * @var Member $to
     */
    private $to;

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
    private $answerDate;

    /**
     * @ORM\Column(name="delete_date", type="datetime", nullable=true)
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
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $from
     * @return FriendshipRequest
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $to
     * @return FriendshipRequest
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getTo()
    {
        return $this->to;
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
     * @param mixed $deleteDate
     * @return FriendshipRequest
     */
    public function setDeleteDate($deleteDate)
    {
        $this->deleteDate = $deleteDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeleteDate()
    {
        return $this->deleteDate;
    }








}
