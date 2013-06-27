<?php

namespace Tripwer\SocialNetworkingBundle\Exception\Friendship;

use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;
use Tripwer\SocialNetworkingBundle\Entity\Member;

class MemberIsNotOwnerOfFriendshipRequest extends \Exception{

    public function __construct(Member $member, FriendshipRequest $friendshipRequest){
        parent::__construct("Member ".$member->getId()." is not owner of friendship request ".$friendshipRequest->getId());
    }
}