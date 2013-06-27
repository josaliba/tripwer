<?php

namespace Tripwer\SocialNetworkingBundle\Exception\Friendship;

use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;


class FriendshipRequestAlreadyAnsweredException extends \Exception{

    public function __construct(FriendshipRequest $request){
        parent::__construct("The friendship request ".$request->getId()." was already answered");
    }

}