<?php

namespace Tripwer\SocialNetworkingBundle\Exception\Friendship;

use Tripwer\SocialNetworkingBundle\Entity\Member;

class FriendshipRequestAlreadyExistsException extends \Exception{

    public function __construct(Member $from, Member $to){
        parent::__construct("A friend request between member ".$from->getId()." and member ".$to->getId()." already exists");
    }

}