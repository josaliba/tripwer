<?php

namespace Tripwer\SocialNetworkingBundle\Manager;

use Doctrine\ORM\EntityManager;
use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\FriendshipRequestAlreadyAnsweredException;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\FriendshipRequestAlreadyExistsException;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\MembersAreNotFriendsException;
use Tripwer\SocialNetworkingBundle\Exception\Member\MemberIsInBlacklistException;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\MembersAreAlreadyFriendsException;

class FriendshipManager{

    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function createRequest(Member $from,Member $to){

        if ($from->hasFriend($to)){
            throw new MembersAreAlreadyFriendsException($from,$to);
        }

        if ($to->hasMemberInBlacklist($from)){
            throw new MemberIsInBlacklistException($to,$from);
        }

        if ($this->requestExists($from,$to)){
            throw new FriendshipRequestAlreadyExistsException($from,$to);
        }

        $friendshipRequest = new FriendshipRequest();

        $friendshipRequest->setFrom($from);
        $friendshipRequest->setTo($to);

        return $friendshipRequest;
    }


    public function requestExists(Member $from, Member $to){


        //a request exist only if the latest request is not answered yet
        /*if (count($requests) && !$requests[0]->isAnswered()){
            return true;
        }

        return false;*/
        return false;
    }

    public function acceptRequest(FriendshipRequest $friendshipRequest,$flush = true){
        if ($friendshipRequest->isAnswered()){
            throw new FriendshipRequestAlreadyAnsweredException($friendshipRequest);
        }

        $friendshipRequest->setAnswered(true);
        $friendshipRequest->setAccepted(true);

        $this->makeFriends($friendshipRequest->getFrom(),$friendshipRequest->getTo(),$flush);

        $this->em->persist($friendshipRequest);

        if ($flush)
            $this->em->flush();
    }

    public function denyRequest(FriendshipRequest $friendshipRequest,$flush = true){

        if ($friendshipRequest->isAnswered()){
            throw new FriendshipRequestAlreadyAnsweredException($friendshipRequest);
        }

        $friendshipRequest->setAnswered(true);
        $friendshipRequest->setAccepted(false);

        if ($flush)
            $this->em->flush();
    }

    public function deleteRequest(FriendshipRequest $friendshipRequest,$flush = true){
        // @todo can an already answered request be deleted?
        $this->em->remove($friendshipRequest);

        if ($flush)
            $this->em->flush();
    }

    public function unfriend(Member $member1, Member $member2, $flush = true){
        if (!$member1->hasFriend($member2)){
            throw new MembersAreNotFriendsException($member1,$member2);
        }
        $member1->removeFriend($member2);

        $this->em->persist($member1);

        if ($flush)
            $this->em->flush();
    }

    public function makeFriends(Member $member1,Member $member2,$flush = true){
        if ($member1->hasFriend($member2)){
            throw new MembersAreAlreadyFriendsException($member1,$member2);
        }

        $member1->addFriend($member2);

        $this->em->persist($member1);

        if ($flush)
           $this->em->flush();

    }

}