<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Tests\Models\Generic\BooleanModel;
use Tripwer\AccountsBundle\Entity\User as TripwerUser;

/**
 * Member
 *
 * @ORM\Table(name="socialnetworking__members")
 * @ORM\Entity
 */
class Member extends TripwerUser
{
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $friends
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable(name="socialnetworking__members__friends",
     *      joinColumns={@ORM\JoinColumn(name="member_initiator_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="member_accepter_id", referencedColumnName="id")}
     *      )
     */
    private $friends;

    /**
     * Members that $this doesn't want to receive friendship requests from
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Member")
     * @ORM\JoinTable(name="socialnetworking__members__blacklist",
     *      joinColumns={@ORM\JoinColumn(name="member_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="blacklisted_member_id", referencedColumnName="id")}
     *      )
     */
    private $blacklistedMembers;

    /**
     * @var Feed $feed
     * @ORM\OneToOne(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Feed")
     * @ORM\JoinColumn(name="feed_id", nullable = false)
     */
    private $feed;


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

    /**
     * @param Feed $feed
     * @return Member
     */
    public function setFeed($feed)
    {
        $this->feed = $feed;
        return $this;
    }

    /**
     * @return Feed
     */
    public function getFeed()
    {
        return $this->feed;
    }





}
