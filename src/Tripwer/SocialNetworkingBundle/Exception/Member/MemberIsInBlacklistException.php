<?php

namespace Tripwer\SocialNetworkingBundle\Exception\Member;

use Tripwer\SocialNetworkingBundle\Entity\Member;

class MemberIsInBlacklistException extends \Exception{
    public function __construct(Member $member, Member $blacklistedMember){
        parent::__construct("Member ".$blacklistedMember->getId()." is in the blacklist of member ".$member->getId());
    }
}