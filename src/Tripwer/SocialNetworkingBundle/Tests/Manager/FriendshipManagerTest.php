<?php

namespace Tripwer\SocialNetworkingBundle\Tests\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Manager\FriendshipManager;

class FriendshipManagerTest extends \PHPUnit_Framework_TestCase{

    /** @var  EntityManager */
    private $entityManager;

    private $doctrineQueryMocker;

    /** @var  EntityRepository */
    private $friendshipRequestRepository;

    /** @var  FriendshipManager */
    private $friendshipManager;



    public function setUp(){
        $this->friendshipRequestRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

       $this->entityManager
           ->expects($this->once())
           ->method('getRepository')
           ->will($this->returnValue($this->friendshipRequestRepository));


        $this->friendshipManager = new FriendshipManager($this->entityManager);

    }

    private function createMockMember($email){

        /** @var Member $member */
        $member = $this->getMock("\Tripwer\SocialNetworkingBundle\Entity\Member");
        $member->setEmail($email);

        return $member;
    }

    public function testCreateRequest(){

        /*$this->entityManager
            ->expects($this->once())
            ->method("createCreateQueryBuilder")
            ->will($this->returnValue(null));
        $memberFrom = $this->createMockmember("test1@test.com");
        $memberTo = $this->createMockMember("test2@test.com");
        $friendshipRequest = $this->friendshipManager->createRequest($memberFrom,$memberTo);

        $this->assertSame($friendshipRequest->getFrom(),$memberFrom);
        $this->assertSame($friendshipRequest->getTo(),$memberTo);*/

    }




}