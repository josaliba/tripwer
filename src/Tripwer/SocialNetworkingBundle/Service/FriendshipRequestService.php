<?php

namespace Tripwer\SocialNetworkingBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Exception\FriendshipRequest\FriendshipRequestAlreadyExistsException;
use Tripwer\SocialNetworkingBundle\Exception\Member\MemberIsInBlacklistException;
use Tripwer\SocialNetworkingBundle\Exception\Member\MembersAreAlreadyFriendsException;

class FriendshipRequestService{


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

        $this->em->persist($friendshipRequest);
        $this->em->flush();
    }

    public function requestExists(Member $from, Member $to){
        $qb = $this->em->createQueryBuilder();
        $requests = $qb->select("r")
            ->from("Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest","r")
            ->where("r.from = :fromMember AND r.to = :toMember")
            ->orWhere("r.from = :toMember AND r.to = :fromMember")
            ->orderBy("r.createDate DESC")
            ->setMaxResults(1)
            ->setParameters(array(
                "fromMember" => $from,
                "toMember" => $to
            ))
            ->getQuery()->getResult();

        //a request exist only if the latest request is not answered yet
        if (count($requests) && !$requests[0]->isAnswered()){
            return true;
        }

        return false;
    }

    public function acceptRequest(FriendshipRequest $friendshipRequest){
        $friendshipRequest->setAnswered(true);
        $friendshipRequest->setAccepted(true);
        $friendshipRequest->getFrom()->addFriend($friendshipRequest->getTo());
        $this->em->persist($friendshipRequest);
        $this->em->flush();
    }

    public function refuseRequest(FriendshipRequest $friendshipRequest){
        $friendshipRequest->setAnswered(true);
        $friendshipRequest->setAccepted(false);
        $this->em->flush();
    }

}