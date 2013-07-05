<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Post
 *
 * @ORM\Table(name="socialnetworking__posts")
 * @Gedmo\SoftDeleteable(fieldName="deleteDate")
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
abstract class Post{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Feed
     * @ORM\ManyToOne(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Feed")
     * @ORM\JoinColumn(name="feed_id", nullable = false)
     */
    private $feed;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Comment", mappedBy="post", cascade={"persist"})
     */
    private $comments;


    /**
     * Members who liked this post
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Member")
     * @ORM\JoinTable(name="socialnetworking__likes__post_likes")
     */
    private $likers;


    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="delete_date", nullable=true)
     */
    private $deleteDate = null;

    public function __construct(){
        $this->comments = new ArrayCollection();
        $this->likers = new ArrayCollection();
    }

    /**
     * @param \DateTime $deleteDate
     * @return Feed
     */
    public function setDeleteDate($deleteDate)
    {
        $this->deleteDate = $deleteDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeleteDate()
    {
        return $this->deleteDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Feed $feed
     * @return Post
     */
    public function setFeed(Feed $feed)
    {
        $this->feed = $feed;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Feed
     */
    public function getFeed()
    {
        return $this->feed;
    }

    public function getComments(){
        return $this->comments;
    }

    public function setComments(ArrayCollection $comments){
        $this->comments = $comments;
        return $this;
    }

    public function addComment(Comment $comment){
        $comment->setPost($this);
        $this->comments->add($comment);
    }

    public function getLikers(){
        return $this->likers;
    }

    public function setLikers(ArrayCollection $likers){
        $this->likers = $likers;
        return $this;
    }

    public function addLiker(Member $member){
        $this->likers->add($member);
        return $this;
    }




}