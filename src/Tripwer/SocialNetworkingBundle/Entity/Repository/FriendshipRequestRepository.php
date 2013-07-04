<?php

namespace Tripwer\SocialNetworkingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Tripwer\SocialNetworkingBundle\Entity\Member;

/**
 * WebServiceInstanceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FriendshipRequestRepository extends EntityRepository
{
    public function findActiveRequestBetweenMembers(Member $member1,Member $member2){
        $qb = $this->_em->createQueryBuilder();
        return $qb->select("r")
            ->from("Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest","r")
            ->where("r.from = :fromMember AND r.to = :toMember")
            ->orWhere("r.from = :toMember AND r.to = :fromMember")
            ->orderBy("r.createDate","DESC")
            ->setMaxResults(1)
            ->setParameters(array(
                "fromMember" => $member1,
                "toMember" => $member2
            ))
            ->getQuery()->getResult();
    }
}