<?php

namespace Tripwer\AccountsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @Gedmo\SoftDeleteable(fieldName="deleteDate")
 * @ORM\DiscriminatorMap({
 *      "social_networking_member" = "Tripwer\SocialNetworkingBundle\Entity\Member"
 * })
 * @todo add constraints and validation messages
 * @todo changed address to be nullable false
 */
abstract class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255, nullable=false)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="date_of_birth", type="datetime", nullable=false)
     */
    private $dateOfBirth;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="subscription_date", type="datetime", nullable=false)
     */
    private $subscriptionDate;

    /**
     * @ORM\Column(name="delete_date", type="datetime", nullable=true)
     */
    private $deleteDate;

    /**
     * @var Address $address
     * @ORM\OneToOne(targetEntity="Address", cascade={"all"})
     * @ORM\JoinColumn(name="address_id", nullable=true)
     */
    private $address;


    public function __construct(){
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param string $dateOfBirth
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    
        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return string 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set address
     *
     * @param Address $address
     * @return User
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \DateTime $subscriptionDate
     * @return User
     */
    public function setSubscriptionDate(\DateTime $subscriptionDate)
    {
        $this->subscriptionDate = $subscriptionDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSubscriptionDate()
    {
        return $this->subscriptionDate;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $deleteDate
     * @return User
     */
    public function setDeleteDate($deleteDate)
    {
        $this->deleteDate = $deleteDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeleteDate()
    {
        return $this->deleteDate;
    }






}
