<?php

namespace Tripwer\SocialNetworkingBundle\Manager;

use Doctrine\ORM\EntityManager;
use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequestNotification;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Exception\Notification\NotificationTypeNotFoundException;

class NotificationManager{

    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }


}