<?php

namespace Tripwer\AccountsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Member
 *
 * @ORM\Table(name="tripwer_users")
 * @ORM\Entity
 * @todo add constraints and validation messages
 */
class User extends BaseUser
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
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=255)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="date_of_birth", type="datetime")
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="subscription_date", type="datetime")
     */
    private $subscriptionDate;


    public function __construct(){
        parent::__construct();
        $this->friends = new ArrayCollection();
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
     * @return Member
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
     * @return Member
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
     * @param string $address
     * @return Member
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \DateTime $subscriptionDate
     * @return Member
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
     * @return Member
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
     * @return Member
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
}