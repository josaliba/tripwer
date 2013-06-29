<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FriendRequestNotification
 *
 * @ORM\Table(name="social_networking_friend_request_notification")
 * @ORM\Entity
 */
class FriendRequestNotification extends Notification
{
    /**
     * @var Member $requester
     * @ORM\ManyToOne(targetEntity="Member")
     */
    private $requester;

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $requester
     * @return FriendRequestNotification
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getRequester()
    {
        return $this->requester;
    }


}
