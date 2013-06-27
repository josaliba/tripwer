<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Tripwer\AccountsBundle\Entity\User as TripwerUser;

/**
 * Member
 *
 * @ORM\Table(name="socialnetworking_members")
 * @ORM\Entity
 */
class Member extends TripwerUser
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $friends
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable(name="socialnetworking_members_friendship_relationship")
     */
    private $friends;

    /**
     * Members that $this doesn't want to receive friendship requests from
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable(name="socialnetworking_members_blacklist")
     */
    private $blacklistedMembers;

    public function __construct(){
        parent::__construct();
        $this->friends = new ArrayCollection();
        $this->blacklistedMembers = new ArrayCollection();

    }

    public function getBlacklistedMembers(){
        return $this->blacklistedMembers;
    }

    public function setBlacklistedMembers(ArrayCollection $blacklist){
        $this->blacklistedMembers = $blacklist;
    }

    public function hasMemberInBlacklist(Member $member){
        return $this->blacklistedMembers->contains($member) || $member === $this;
    }

    public function removeMemberFromBlacklist(Member $member){
        $this->blacklistedMembers->removeElement($member);
    }

    public function addMemberToBlacklist(Member $member){
        $this->blacklistedMembers->add($member);
    }

    public function getFriends(){
        return $this->friends;
    }

    public function setFriends(ArrayCollection $friends){
        $this->friends = $friends;
        return $this;
    }

    public function hasFriend(Member $member){
        return $this->friends->contains($member);

    }

    public function addFriend(Member $member, $reverse = true){
        $this->friends->add($member);
        if ($reverse){
            $member->addFriend($this,false);
        }

        return $this;
    }

    public function removeFriend(Member $member, $reverse = true){
        $this->friends->removeElement($member);
        if ($reverse){
            $member->removeFriend($this,false);
        }

        return $this;
    }


}
