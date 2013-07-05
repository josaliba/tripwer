<?php

namespace Tripwer\SocialNetworkingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Tripwer\SocialNetworkingBundle\Entity\Member;
use Tripwer\SocialNetworkingBundle\Entity\Post;

/**
 * @ORM\Entity()
 * @ORM\Table(name="socialnetworking__comments")
 * @Gedmo\SoftDeleteable(fieldName="deleteDate")
 */
class Comment{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Member
     * @ORM\ManyToOne(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Member")
     * @ORM\JoinColumn(name="author_id", nullable=false)
     */
    private $author;

    /**

     * @ORM\Column(type="text", name="comment")
     */
    private $comment;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="deleted_date", type="datetime", nullable=true)
     */
    private $deleteDate = null;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="Tripwer\SocialNetworkingBundle\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", nullable=true)
     */
    private $post;

    /**
     * @param \Tripwer\SocialNetworkingBundle\Entity\Member $author
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Member
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param  $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param \DateTime $createDate
     * @return Comment
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $deleteDate
     * @return Comment
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
     * @param \Tripwer\SocialNetworkingBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return \Tripwer\SocialNetworkingBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }




}