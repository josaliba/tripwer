<?php

namespace Tripwer\SocialNetworkingBundle\Entity\Notifications;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;
use Tripwer\SocialNetworkingBundle\Entity\Notification;

/**
 * FriendshipRequestAcceptedNotification
 * @ORM\Table(name="socialnetworking__notifications__friendship_request_accepted")
 * @ORM\Entity()
 */
class FriendshipRequestAcceptedNotification extends Notification
{
    /**
     * @var FriendshipRequest
     * @ORM\OneToOne(targetEntity="Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest")
     * @ORM\JoinColumn(name="friendship_request_id",nullable=false)
     */
    private $friendshipRequest;

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest $friendshipRequest
     * @return FriendshipRequestAcceptedNotification
     */
    public function setFriendshipRequest($friendshipRequest)
    {
        $this->friendshipRequest = $friendshipRequest;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest
     */
    public function getFriendshipRequest()
    {
        return $this->friendshipRequest;
    }


}