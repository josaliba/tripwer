<?php

namespace Tripwer\SocialNetworkingBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tripwer\SocialNetworkingBundle\Entity\FriendshipRequest;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\MemberIsNotOwnerOfFriendshipRequest;
use Tripwer\SocialNetworkingBundle\Exception\Friendship\MemberIsNotRecipientOfFriendshipRequest;
use Tripwer\SocialNetworkingBundle\Manager\FriendshipManager;
use JMS\DiExtraBundle\Annotation as DI;


class FriendshipController extends Controller{


    /**
     * @var EntityManager $em
     * @DI\Inject("doctrine.orm.entity_manager")
     */
    private $em;

    /**
     * @Route("/friendship/{id}/request", name="socialnetworking.friendship.send_request")
     * @Secure("ROLE_USER")
     * @Method("POST")
     * @ParamConverter("member", class="TripwerSocialNetworkingBundle:Member")
     */
    public function sendRequestAction(Member $member){
        /** @var FriendshipManager $friendshipManager */
        $friendshipManager = $this->get("tripwer.socialnetworking.friendship_manager");
        $user = $this->get("security.context")->getToken()->getUser();

        $friendshipRequest = $friendshipManager->createRequest($user,$member);

        $this->em->persist($friendshipRequest);
        $this->em->flush();

        //@todo redirect to $member profile
    }

    /**
     * @Route("/friendship/{id}/accept", name="socialnetworking.friendship.accept_request")
     * @Secure("ROLE_USER")
     * @ParamConverter("friendshipRequest", class="TripwerSocialNetworkingBundle:FriendshipRequest")
     */
    public function acceptRequestAction(FriendshipRequest $friendshipRequest){

        $user = $this->get("security.context")->getToken()->getUser();
        if ($friendshipRequest->getTo() === $user){
            /** @var FriendshipManager $friendshipManager */
            $friendshipManager = $this->get("tripwer.socialnetworking.friendship_manager");
            $friendshipManager->acceptRequest($friendshipRequest);
        }else{
            throw new MemberIsNotRecipientOfFriendshipRequest($user,$friendshipRequest);
        }

        //@todo redirect to $friendshipRequest()->getFrom() profile
    }

    /**
     * @Route("/friendship/{id}/deny",name="socialnetworking.friendship.deny_request")
     * @Secure("ROLE_USER")
     * @ParamConverter("friendshipRequest", class="TripwerSocialNetworkingBundle:FriendshipRequest")
     */
    public function denyRequestAction(FriendshipRequest $friendshipRequest){
        $user = $this->get("security.context")->getToken()->getUser();
        if ($friendshipRequest->getTo() === $user){
            /** @var FriendshipManager $friendshipManager */
            $friendshipManager = $this->get("tripwer.socialnetworking.friendship_manager");
            $friendshipManager->denyRequest($friendshipRequest);
        }else{
            throw new MemberIsNotRecipientOfFriendshipRequest($user,$friendshipRequest);
        }

        //@todo redirect to $user profile
    }

    public function deleteRequestAction(FriendshipRequest $friendshipRequest){
        $user = $this->get("security.context")->getToken()->getUser();

        if ($friendshipRequest->getFrom() !== $user){
            throw new MemberIsNotOwnerOfFriendshipRequest($user,$friendshipRequest);
        }

        /** @var FriendshipManager $friendshipManager */
        $friendshipManager = $this->get("tripwer.socialnetworking.friendship_manager");
        $friendshipManager->deleteRequest($friendshipRequest);

        // @todo redirect to $user profile

    }

    /**
     * @Route("/{id}/unfriend", name="socialnetworking.friendship.unfriend")
     * @Secure("ROLE_USER")
     * @ParamConverter("member", class="TripwerSocialNetworkingBundle:Member")
     */
    public function unfriendAction(Member $member){
        /** @var Member $user */
        $user = $this->get("security.context")->getToken()->getUser();
        /** @var FriendshipManager $friendshipManager */
        $friendshipManager = $this->get("tripwer.socialnetworking.friendship_manager");

        $friendshipManager->unfriend($user,$member);

        // @todo redirect to $user profile
    }

    /**
     * @Route("/friends", name="socialnetworking.friendship.list_friends")
     */
    public function listFriendsAction(){
        /** @var Member $user */
        $user = $this->get("security.context")->getToken()->getUser();

        return $user->getFriends();
    }



}